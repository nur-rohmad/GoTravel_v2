<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::orderBy('id', 'desc')->get();
        return view('admin.wisata.index', compact('wisata'));
    }

    // loaad halaman wisata
    public function create()
    {
        return view('admin.wisata.create');
    }

    // process create wisata
    public function procces_create(Request $request)
    {

        $wisata = $request->validate([
            'nama_wisata' => 'required',
            'kota' => 'required',
            'deskripsi' => 'required',
            // 'demo' => 'required|image',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required'
        ]);
        $wisata['location'] = json_encode([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        Wisata::create($wisata);

        return redirect('/admin/wisata');
    }
}
