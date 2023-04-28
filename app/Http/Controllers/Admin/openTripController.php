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
        
        return view('admin.open-trip.index', compact('openTrip'));
    }

    // render halaman create open trip
    public function create()
    {
        $wisata = Wisata::select('id', 'nama_wisata')->where('status', 'publish')->get();
        return view('admin.open-trip.create', compact('wisata'));
    }

    // proses create open trip
    public function prosesCreate(Request $request)
    {
        $openTrip =  $request->validate([
            'title' => 'required',
            'tgl_berangkat' => 'required|date',
            'jumlah_peserta' => 'required|numeric',
            'poster' => 'required|image',
            'lama_open_trip' => 'required|numeric',
            'harga' => 'required',
            'deskripsi' => 'required',
            'lokasi_tujuan' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);
        // penambahan input
        $openTrip['slug'] = str_replace(' ', '-', strtolower($request->title));
        $openTrip['lokasi_tujuan'] = json_encode($request->lokasi_tujuan);
        $openTrip['poster'] = $request->file('poster')->store('open-trip/poster'); //upload poster
        $openTrip['lokasi_penjemputan'] = json_encode([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        // create data opentrip
        OpenTrip::create($openTrip);

        return redirect('admin/open-trip')->with('success', 'data berhasil ditambahkan');
    }

    // show
    public function show($slug)
    {
        // get data open trip
        $openTrip = OpenTrip::where('slug', $slug)->first();

        if (!$openTrip) {
            return back()->with('gagal', 'Data open trip tidak ditemukan');
        }

        return view('admin.open-trip.show', compact('openTrip'));
    }

    // edit
    public function edit($slug)
    {
         // data wisata
         $wisata = Wisata::select('id', 'nama_wisata')->where('status', 'publish')->get();

         // get data open trip
         $openTrip = OpenTrip::where('slug', $slug)->first();

         if (!$openTrip) {
             return back()->with('gagal', 'Data open trip tidak ditemukan');
         }
 
         return view('admin.open-trip.edit', compact('openTrip', 'wisata'));
    }
}
