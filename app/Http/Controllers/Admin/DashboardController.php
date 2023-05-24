<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\OpenTrip;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahUser = User::where('role', 'pelanggan')->where('status', 1)->count();
        $jumlahWisata = Wisata::count();
        $jumlahOpenTrip = OpenTrip::count();
        $pendapatanInMounth = Invoice::with(['booking'])->whereMonth('created_at', date("m"))->whereHas('booking', function ($query) {
            $query->where('status', 'dibayar');
        })->sum('amount');
        $bookingUnpaid = Booking::where('status', 'menunggu_pembayaran')->get();
        $openTripBestselling =
            Booking::with(['open_trip', 'invoice'])->select(DB::raw('sum(jumlah_booking) as jumlah, id_openTrip'))->where('status', 'dibayar')->groupBy('id_openTrip')->limit(5)->get();
        // dd($openTripBestselling);
        return view('admin.dashboard', compact('openTripBestselling', 'bookingUnpaid', 'jumlahUser', 'jumlahWisata', 'jumlahOpenTrip', 'pendapatanInMounth'));
    }

    public function getDataGrafik()
    {
        $data = Invoice::with(['booking'])->select(DB::raw('sum(amount) as pendapatan, MONTHNAME(created_at) as bulan_invoice'))->whereHas('booking', function ($query) {
            $query->where('status', 'dibayar');
        })->groupBy('bulan_invoice')->get();

        $pendapatan = [];
        $bulan = [];
        foreach ($data as $key => $value) {
            $pendapatan[] = $value->pendapatan;
            $bulan[] = $value->bulan_invoice;
        }
        $grafik = [
            'pendapatan' => $pendapatan,
            'bulan' => $bulan
        ];
        return response()->json($grafik);
    }
}
