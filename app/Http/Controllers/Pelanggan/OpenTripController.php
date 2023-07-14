<?php

namespace App\Http\Controllers\pelanggan;

use App\Http\Controllers\Controller;
use App\Models\OpenTrip;
use Carbon\Carbon;
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
            $openTrip->whereBetween('tgl_berangkat', [
                Carbon::parse($request->tgl_berangkat, 'UTC')->setTime(0, 0)->timezone('UTC')->toDateTimeString(),
                Carbon::parse($request->tgl_berangkat, 'UTC')->setTime(23, 59, 59)->timezone('UTC')->toDateTimeString(),
            ]);
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
