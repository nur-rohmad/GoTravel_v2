<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class openTripController extends Controller
{
    public function index(Request $request)
    {
        $openTrip = OpenTrip::get();

        return view('admin.open-trip.index', compact('openTrip'));

    }

    // render halaman create open trip
    public function create()
    {
        return view('admin.open-trip.create');
    }
}
