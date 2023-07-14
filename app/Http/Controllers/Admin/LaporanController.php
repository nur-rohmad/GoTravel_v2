<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $booking = Booking::where('status', 'dibayar')->orderBy('created_at')->get();
        return view('admin.laporan.index', compact('booking'));
    }
}
