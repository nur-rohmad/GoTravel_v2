<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\OpenTrip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $booking = Booking::where('status', 'dibayar')->orderBy('created_at');

        // jika terdapat filter tanggal 
        if ($request->has('start_date') && $request->start_date != null && $request->has('end_date') && $request->end_date != null) {
            $booking->whereBetween('created_at', [
                Carbon::parse($request->start_date, 'UTC')->setTime(0, 0)->timezone('UTC')->toDateTimeString(),
                Carbon::parse($request->end_date, 'UTC')->setTime(23, 59, 59)->timezone('UTC')->toDateTimeString(),
            ]);
        }

        // get data
        $booking = $booking->get();

        return view('admin.laporan.index', compact('booking'));
    }
}
