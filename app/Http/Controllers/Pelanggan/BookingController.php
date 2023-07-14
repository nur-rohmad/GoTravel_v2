<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ChanelPembayaran;
use App\Models\Invoice;
use App\Models\OpenTrip;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();
        $booking = Booking::with('invoice')->where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        // dd($booking);
        return view('pelanggan.booking.index', compact('booking'));
    }

    // create booking
    public function create($slug)
    {
        $openTrip = OpenTrip::where('slug', $slug)->first();
        $chanelPembayaran = ChanelPembayaran::where('status', 'active')->get();
        if (!$openTrip) {
            return back()->with('gagal', 'Open trip tidak ditemukan');
        } else {
            return view('pelanggan.booking.create', compact('openTrip', 'chanelPembayaran'));
        }
    }

    // checkout
    public function checkout(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'metode_pembayaran' => 'required',
            'open_trip' => 'required',
            'jumlah' => 'required'
        ]);

        // get data user
        $user = auth()->user();
        // get data open trip
        $openTrip = OpenTrip::where('id', $request->open_trip)->first();

        // get data chanel pembayaran
        $chanelPembayaran = ChanelPembayaran::find($request->metode_pembayaran);

        // jumlah pemabayaran 
        $jumlahPembayaran = (int)$request->jumlah * (int)$openTrip->harga;
        DB::beginTransaction();
        try {
            // create booking 
            $booking = Booking::create([
                'id' => "B-" . date("YmdHIs") . rand(4, 4),
                'user_id' => $user->id,
                'id_openTrip' => $openTrip->id,
                'email_tujuan' => $user->email,
                'jumlah_booking' => $request->jumlah,
                'status' => 'menunggu_pembayaran'
            ]);

            $openTrip->update([
                'sisa_kuota' => (int)$openTrip->sisa_kuota - (int)$request->jumlah
            ]);

            // conect to midtrans
            $payload = [
                "payment_type" => $chanelPembayaran->payment_type,
                "transaction_details" => [
                    "order_id" => "GT-" . date("YmdHIs") . rand(4, 9),
                    "gross_amount" => $jumlahPembayaran
                ],
                "item_details" => [
                    "price" => $openTrip->harga,
                    "quantity" => $request->jumlah,
                    "name" => $openTrip->title
                ],
                "customer_details" => [
                    "first_name" => $user->name,
                    "last_name"=> "",
                    "email" => $user->email,
                ],
                "expiry" => [
                    'start_time' => date("Y-m-d H:i:s O", time()),
                    'unit' => 'minute',
                    'duration'  => 1440
                ],
            ];

            if ($chanelPembayaran->payment_type == 'bank_transfer') {
                $payload['bank_transfer'] = [
                    "bank" => $chanelPembayaran->payment_code
                ];
            } elseif ($chanelPembayaran->payment_type == 'cstore') {
                $payload['cstore'] = [
                    "store" => $chanelPembayaran->payment_code,
                    "message" => "Pembayaran Go Travel",
                ];
            } elseif ($chanelPembayaran->payment_type == 'gopay') {
                $payload['gopay'] = array(
                    'enable_callback' => true,                // optional
                    'callback_url' => 'someapps://callback'   // optional
                );
            }

            $responseMidtrans = Http::accept('application/json')->withHeaders([
                'Authorization' => base64_encode(env('MIDTRANS_SERVERKEY'))
            ])->post('https://api.sandbox.midtrans.com/v2/charge', $payload);

            $responseJson = $responseMidtrans->json();
            if ($responseJson['status_code'] != 201) {
                dd($responseJson);
                return back()->with('gagal', "Pembayaran Gagal");
            }
            // create invoice
            $dataInvoice = [
                'id' => $responseJson['order_id'],
                'id_booking' => $booking->id,
                'id_chanel_pembayaran' => $request->metode_pembayaran,
                "amount" => $responseJson['gross_amount'],
                "metode_pembayaran" => $responseJson['payment_type'],
                // "waktu_expired" => $responseJson['expiry_time']
            ];

            if ($responseJson['payment_type'] == 'bank_transfer') {
                $dataInvoice['va_number'] = $responseJson['va_numbers'][0]['va_number'];
                $dataInvoice['bank'] = $responseJson['va_numbers'][0]['bank'];
            } elseif ($responseJson['payment_type'] == 'gopay') {
                $dataInvoice['bank'] = 'GOPAY';
                $dataInvoice['pay_url'] = $responseJson['actions'][0]['url'];
            } elseif ($responseJson['payment_type'] == 'cstore') {
                $dataInvoice['va_number'] = $responseJson['payment_code'];
                $dataInvoice['bank'] = $responseJson['store'];
            }

            $invoice = Invoice::create($dataInvoice);
            DB::commit();
            return Redirect('pelanggan/booking');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            info('errpor', [$th]);
            return redirect('pelanggan/wisata');
        }
    }

    public function detail($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return back();
        }
        return view('pelanggan.booking.show', compact('invoice'));
    }

    public function cetakTiket($idBooking)
    {
        $booking = Booking::find($idBooking);
        if (!$idBooking) {
            abort(404);
        }
        $ticket = Ticket::where('id_booking', $idBooking)->get();
        if (count($ticket) < 1) {
            // buat tilet baru
            for ($i = 0; $i < $booking->jumlah_booking; $i++) {
                $no_ticket = 'GT-' . Str::random(10);
                Ticket::create([
                    'id_booking' => $idBooking,
                    'no_ticket' => $no_ticket,
                    // 'qrcode' => $this->generateQrcode($no_ticket)
                ]);
            }
            $ticket = Ticket::where('id_booking', $idBooking)->get();
        }
            $pdf = pdf::loadView('ticket', compact('ticket', 'booking'))->setPaper(array(0, 0, 595.276, 226.772));
            return $pdf->stream();
        // return view('ticket', compact('ticket', 'booking'));
    }

    // function create qrcode
    // private function generateQrcode($content)
    // {
    //     $image =  QrCode::format('png')->generate($content);
    //     Storage::disk('local')->put('/ticket/qrcode/' . $content, $image);
    //     // $filename =  $image->store('ticket/qrcode');

    //     return true;
    // }
}
