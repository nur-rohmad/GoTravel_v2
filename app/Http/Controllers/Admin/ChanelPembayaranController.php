<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ChanelPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChanelPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $chanelPembayaran = ChanelPembayaran::all();

        return view('admin.chanel-pembayaran.index', compact('chanelPembayaran'));
    }


    public function create(Request $request)
    {
        $validate =  $request->validate([
            'name' => 'required',
            'payment_type' => 'required',
            'payment_code' => 'required',
            'status' => 'required',
            'image' => 'required|image|max:5120'
        ]);

        $validate['image'] = $request->file('image')->store('chanel-pembayaran/logo');

        $simpan = ChanelPembayaran::create($validate);

        if ($simpan) {
            return response()->json([
                'success' => true,
                'message' => 'berhasil menambahkan chanel pembayaran'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'gagal menambahkan chanel pembayaran'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        info('req', [$request->all()]);
        $validate =  $request->validate([
            'id' => 'required',
            'name' => 'required',
            'payment_type' => 'required',
            'payment_code' => 'required',
            'status' => 'required',
            'image' => 'image|max:5120'
        ]);


        // get data old
        $chanelPembayaran = ChanelPembayaran::find($request->id);

        if ($request->file('image')) {
            $validate['image'] = $request->file('image')->store('chanel-pembayaran/logo');
            if ($chanelPembayaran->image) {
                Storage::delete($chanelPembayaran->image);
            }
        }

        $simpan = ChanelPembayaran::where('id', $request->id)->update($validate);

        if ($simpan) {
            return response()->json([
                'success' => true,
                'message' => 'berhasil mengubah chanel pembayaran'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'gagal mengubah chanel pembayaran'
            ], 500);
        }
    }
}
