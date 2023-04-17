<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OpenTrip;
use App\Models\Wisata;
use Illuminate\Http\Request;

class openTripController extends Controller
{
    public function index(Request $request)
    {
        $openTrip = OpenTrip::get();
        dd($openTrip);
        return view('admin.open-trip.index', compact('openTrip'));

    }

    // render halaman create open trip
    public function create()
    {
        $wisata = Wisata::where('status', 'publish')->get();
        return view('admin.open-trip.create', compact('wisata'));
    }

    // proses create open trip
    public function prosesCreate(Request $request)
    {
       $openTrip =  $request->validate([
            'title' => 'required',
            'tgl_berangkat' => 'required|date',
            'jumlah_peserta' => 'required|numeric',
            // 'poster' => 'required|image'
            'lama_open_trip' => 'required|numeric',
            'harga' => 'required',
            'deskripsi' => 'required',
            'lokasi_tujuan' => 'required'

        ]);
        $openTrip['slug'] = str_replace(' ', '-', strtolower($request->title));
        $openTrip['lokasi_tujuan'] = json_encode($request->lokasi_tujuan);
        

        OpenTrip::create($openTrip);

        return redirect('admin/open-trip')->with('success', 'data berhasil ditambahkan');
        // dd($request->all());
    }
}
