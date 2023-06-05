<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('last_login', 'DESC')->get();

        return view('admin.user.index', compact('user'));
    }

    // update user
    public function update(Request $request)
    {
        $rule =  [
            "id" => "required",
            "name" => "required",
            "email" => "required|email",
            "status" => "required",
            "role" => "required"
        ];

        if ($request->has('password') && $request->password !== null) {
            $rule['password'] = "required";
        }

        // validasi input
        $request->validate($rule);

        // cek user
        $user = User::where('id', $request->id)->first();

        // jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "user tidak ditemukan"
            ], 503);
        }

        // jika ditemukan maka lanjutkan proses update
        $data = [
            "email" => $request->email,
            "name" => $request->name,
            "status" => $request->status,
            "role" => $request->role,
            "NoHP" => $request->NoHP,
            "alamat" => $request->alamat
        ];

        // jika password diisi
        if ($request->has('password') && $request->password !== null) {
            $new_password = Hash::make($request->password);
            $data['password'] = $new_password;
        }

        // update data user
        if ($user->update($data)) {
            return response()->json([
                "success" => true,
                "message" => "Berhasil update data user"
            ]);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Gagal Update Data User"
            ], 503);
        }
    }
}
