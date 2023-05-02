<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $wisata = Wisata::where('status', 'publish');
        $kota_wisata = Wisata::select('kota')->where('status', 'publish')->distinct()->get();

        if ($request->has('search') && $request->search != null) {
            $wisata->where('nama_wisata', 'LIKE', '%'.$request->search.'%');
        }

        if ($request->has('kota') && $request->kota != 'all') {
            $wisata->where('kota', $request->kota);
        }

        $wisata = $wisata->paginate(10);

        return view('pelanggan.wisata.index', compact('wisata', 'kota_wisata'));
    }
}
