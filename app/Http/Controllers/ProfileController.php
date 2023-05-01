<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //index
    public function index()
    {
        // user current login
        $user = auth()->user();

        // get data user from database
        $user_data = User::find($user->id);

        return view('profile', compact('user_data'));
    }

    // update passord
    public function updatePassword(Request $request)
    {
        // get data user
        $user = User::find($request->id);
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);
        // check current password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect('/profile')->with('gagal', 'Password lama salah');
        }

        // hash password
        $new_password_hash =  Hash::make($request->password);

        // update password
        $user->update([
            'password' => $new_password_hash
        ]);

        return redirect('/profile')->with('success', 'Password berhasil diubah');
    }

    // update profile
    public function updateProfile(Request $request)
    {
        // get data old profile user
        $user = User::find($request->id);
        $rules = [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email|email:dns',
            'NoHP' => 'required|numeric',
            'alamat' => 'required|min:20',
        ];

        // check apakah ada inputan ada gambar
        if ($request->file('foto_profile')) {
            $rules['foto_profile'] = 'image|max:5120';
        }

        $validate = $request->validate($rules);

        if ($request->file('foto_profile')) {
            $validate['foto_profile'] = $request->file('foto_profile')->store('user/foto-profile');
        }

        // update data user
        User::where('id', $request->id)->update($validate);

        // delete
        if ($request->file('foto_profile')) {
             // delete foto profile lama
             if ($user->foto_profile) {
                Storage::delete($user->foto_profile);
            }
        }
        return redirect('/profile')->with('success', 'Profile berhasil diupdate');
    }
}
