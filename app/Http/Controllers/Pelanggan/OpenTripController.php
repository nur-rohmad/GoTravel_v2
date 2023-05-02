<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class OpenTripController extends Controller
{
    public function index(Request $request) 
    {
        $openTrip = OpenTrip::orderBy('tgl_berangkat', 'desc')->paginate(10);
        return view('pelanggan.open-trip.index', compact('openTrip'));
    }
}
