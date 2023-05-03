<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // create booking
    public function create($slug)
    {
        $openTrip = OpenTrip::where('slug', $slug)->first();

        if (!$openTrip) {
            return back()->with('gagal', 'Open trip tidak ditemukan');
        }else{
            return view('pelanggan.booking.create', compact('openTrip'));
        }
    }
}
