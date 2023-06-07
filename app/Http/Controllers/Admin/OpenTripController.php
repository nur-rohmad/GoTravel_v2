<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\OpenTrip;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpenTripController extends Controller
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
        $openTrip['sisa_kuota'] = $request->jumlah_peserta;
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

    // proses edit
    public function proccess_edit(Request $request)
    {
        // data lama 
        $old_openTrip = OpenTrip::find($request->id);
        $openTrip =  $request->validate([
            'title' => 'required',
            'tgl_berangkat' => 'required|date',
            'jumlah_peserta' => 'required|numeric',
            'poster' => 'image|max:5210',
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
        $openTrip['lokasi_penjemputan'] = json_encode([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        // upload gambar 
        if ($request->file('poster')) {
            $openTrip['poster'] = $request->file('poster')->store('open-trip/poster'); //upload poster
            // delete file lama
            if ($old_openTrip->poster) {
                Storage::delete($old_openTrip->poster);
            }
        }
        // hilangkan bagisan yang tidak perlu
        unset($openTrip['latitude']);
        unset($openTrip['longitude']);

        OpenTrip::where('id', $request->id)->update($openTrip);
        return redirect('admin/open-trip')->with('success', 'data berhasil diupdate');
    }

    // delete open trip
    public function delete(Request $request)
    {
        $request->validate([
            'id_openTrip' => 'required'
        ]);

        // cari data openTrip
        $openTrip = OpenTrip::where('id', $request->id_openTrip)->first();

        // check apakah data opentrip terdapat pada booking
        $booking = Booking::where('id_openTrip', $request->id_openTrip)->first();

        // jika data openTrip tidak ditemukan kembalikan error
        if (!$openTrip) {
            return response()->json([
                'success' => false,
                'message' => 'data Open Trip tidak ditemukan'
            ], 404);
        }

        // jika ditemukan data opentrip pada booking maka tolak penghapusan data
        if ($booking) {
            return response()->json([
                "success" => false,
                "message" => "Data Open Trip yang telah dibooking tidak dapat dihapus"
            ], 503);
        }

        // hapus data dari database 
        $openTrip->delete();
        if ($openTrip->poster != null) {
            Storage::delete($openTrip->poster);
        }

        return response()->json([
            'success' => false,
            'message' => 'data Open Trip berhasil dihapus'
        ], 200);
    }
}
