<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class OpenTripController extends Controller
{
    public function index(Request $request)
    {
        $openTrip = OpenTrip::orderBy('tgl_berangkat', 'desc');

        if ($request->has('search') && $request->search != null) {
            $openTrip->where('title', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->has('tgl_berangkat') && $request->tgl_berangkat != null) {
            $openTrip->where('tgl_berangkat', $request->tgl_berangkat);
        }

        $openTrip = $openTrip->paginate(6);
        return view('pelanggan.open-trip.index', compact('openTrip'));
    }

    public function show($slug)
    {
        $openTrip = OpenTrip::where('slug', $slug)->first();

        if (!$openTrip) {
            abort(404);
        }
        return view('pelanggan.open-trip.show', compact('openTrip'));
    }
}
