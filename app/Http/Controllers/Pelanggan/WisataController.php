<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $wisata = Wisata::where('status', 'publish')->paginate(10);
        $kota_wisata = Wisata::select('kota')->where('status', 'publish')->distinct()->get();

        return view('pelanggan.wisata.index', compact('wisata', 'kota_wisata'));
    }
}
