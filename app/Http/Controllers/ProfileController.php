<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // dd($request);
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
}
