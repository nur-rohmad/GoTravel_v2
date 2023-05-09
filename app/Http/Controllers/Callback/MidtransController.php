<?php

namespace App\Http\Controllers\Callback;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MidtransController extends Controller
{
    public function index()
    {
        $json_result = file_get_contents('php://input');
        $transaction = json_decode($json_result);

        $serverKey = env('MIDTRANS_SERVERKEY');
        $string_signiture = $transaction->order_id.$transaction->status_code.$transaction->gross_amount.$serverKey;

        // create signiture
        $signature = hash('sha512', $string_signiture);

        // verif signiture
        if ($transaction->signature_key != $signature) {
            return response()->json([
                'success' => false,
                'message' => 'Signature dos not match'
            ]);
        }


        // get data invoice
        $invoice = Invoice::where('id', $transaction->order_id)->first();
        // get data booking
        $booking = Booking::where('id', $invoice->id_booking)->first();

            if($transaction->transaction_status == 'settlement'){
                // update status booking to proses
                $booking->update([
                    'status' => 'dibayar'
                ]);
                // update invoice
                $invoice->update([
                    'waktu_bayar' => $transaction->transaction_time
                ]);
            }
            else if ($transaction == 'expire') {
                // update status booking to proses
                $booking->update([
                    'status' => 'gagal'
                ]);
            }
            else if ($transaction == 'cancel') {
            // update status booking to proses
            $booking->update([
                'status' => 'gagal'
            ]);
          }
    }
}
