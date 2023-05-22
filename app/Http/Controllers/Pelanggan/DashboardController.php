<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\OpenTrip;
use App\Models\Wisata;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $booking = Booking::where('user_id', auth()->user()->id)->count();
        $jumlahPpenTrip = OpenTrip::count();
        $jumlah_wisata = Wisata::where('status', 'publish')->count();
        $wisata_latest = Wisata::orderBy('created_at', 'desc')->limit(2)->get();
        $bestselling_openTrip = OpenTrip::orderBy('sisa_kuota', 'asc')->limit(2)->get();
        $data = [
            'booking' => $booking,
            'jumlah_openTrip' => $jumlahPpenTrip,
            'jumlah_wisata' => $jumlah_wisata,
            'wisata_lastest' => $wisata_latest,
            'bestselling_opentrip' => $bestselling_openTrip
        ];
        return view('pelanggan.dashboard', compact('data'));
    }

    public function getSecadue()
    {
        $terbooking = Booking::where('user_id', auth()->user()->id)->where('status', 'dibayar')->get();
        $data_terbooking = [];
        $idOpenTrip = null;
        foreach ($terbooking as $key => $value) {
            if ($value['open_trip']['id'] != $idOpenTrip) {
                $idOpenTrip = $value['open_trip']['id'];
                $data_terbooking[$key]['title'] = 'Booking ' . $value['open_trip']['title'];
                $data_terbooking[$key]['start'] = date('Y-m-d', strtotime($value['open_trip']['tgl_berangkat']));
                $data_terbooking[$key]['end'] = date('Y-m-d', strtotime("+" . $value['open_trip']['lama_open_trip'] . " Days", strtotime($value['open_trip']['tgl_berangkat'])));
                $data_terbooking[$key]['color'] = 'red';
            }
        }

        return response()->json($data_terbooking);
    }
}
