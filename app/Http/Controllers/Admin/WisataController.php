<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::orderBy('id', 'desc')->get();
        // dd($wisata);
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
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'image' => 'required|image|max:5120'
        ]);

        $wisata['location'] = json_encode([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        // upload image
        $wisata['image'] = $request->file('image')->store('cover-wisata');

        if (Wisata::create($wisata)) {
            return redirect('/admin/wisata')->with('success', 'Berhasil menambahkan data');
        } else {
            return back()->with('gagal', 'Gagal menambahkan data');
        }
    }

    // edit
    public function edit($id)
    {
        $wisata = Wisata::where('id', $id)->first();
        if (!$wisata) {
            return redirect('/admin/wisata')->with('gagal', 'data tidak ditemukan');
        }
        return view('admin.wisata.edit', compact('wisata'));
    }

    // procceess edit
    public function procces_edit(Request $request)
    {
        // data old
        $wisata = Wisata::where('id', $request->id)->first();
        $wisata_new = $request->validate([
            'id' => 'required',
            'nama_wisata' => 'required',
            'kota' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'image' => 'image|max:5120'
        ]);

        // create location to json
        $location = json_encode([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        $foto = null;
        if ($request->file('image')) {
            // hapus gambar lama jika ada
            if ($wisata->image) {
                Storage::delete($wisata->image);
            }
            $foto = $request->file('image')->store('cover-wisata');
        }

        // update data
        $update_wisata = Wisata::where('id', $request->id)->update([
            'nama_wisata' => $request->nama_wisata,
            'kota' => $request->kota,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'location' => $location,
            'image' => $foto != null ? $foto : $wisata->image
        ]);

        // cek apakah data terupdate
        if ($update_wisata) {
            return redirect('/admin/wisata')->with('success', 'Berhasil mengubah data');
        } else {
            return back()->with('gagal', 'Gagal menambahkan data');
        }
    }

    // delete wisata
    public function delete(Request $request)
    {
        $request->validate([
            'id_wisata' => 'required'
        ]);

        // cari data wisata
        $wisata = Wisata::where('id', $request->wisata_id)->first();

        // jika data wisata tidak ditemukan kembalikan error
        if (!$wisata) {
            return response()->json([
                'success' => false,
                'message' => 'data wisata tidak ditemukan'
            ], 404);
        }

        // hapus data dari database 
        $wisata->delete();
        Storage::delete($wisata->image);

        return response()->json([
            'success' => false,
            'message' => 'data wisata berhasil dihapus'
        ], 200);
    }
}
