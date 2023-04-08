<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;

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
            // 'image' => 'required'
        ]);

        $wisata['location'] = json_encode([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);
        
        if(Wisata::create($wisata)){
            return redirect('/admin/wisata')->with('success', 'Berhasil menambahkan data');
        }else{
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
        $wisata_new = $request->validate([
            'id' => 'required',
            'nama_wisata' => 'required',
            'kota' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            // 'image' => 'required'
        ]);

        // create location to json
        $location = json_encode([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        // update data
        $update_wisata = Wisata::where('id', $request->id)->update([
            'nama_wisata' => $request->nama_wisata,
            'kota' => $request->kota,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'location' => $location,
        ]);

        // cek apakah data terupdate
        if($update_wisata){
            return redirect('/admin/wisata')->with('success', 'Berhasil mengubah data');
        }else{
            return back()->with('gagal', 'Gagal menambahkan data');
        }
    }
}
