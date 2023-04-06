<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        if (!Auth::user()) {
            return view('auth.form_login');
        }
    }

    public function procces_login(Request $request)
    {

        $data_login = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:6'
        ]);

        // dd($data_login);
        if (Auth::Attempt($data_login)) {
            $request->session()->regenerate();
            switch (auth()->user()->role) {
                case 'admin':
                    return redirect('admin/dashboard');
                    break;
                case 'pelanggan':
                    return redirect('pelanggan/dashboard');
                    break;
                default:
                    return abort(403);
                    break;
            }
        } else {
            return back()->with('error', 'login akun gagal');
        }
    }

    public function logouth()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda Berhasil Logouth');
    }

    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'nama harus diisi',
            'email.required' => 'email harus diisi',
            'email.email' => 'email tidak valid',
            'email.unique' => 'email telah terdaftar',
            'password.required' => 'password harus diisi',
            'password.min' => 'password harus lebih dari atau sama dengan  6 karakter'
        ]);

        $user['status'] = 1;
        $user['role'] = 'pelanggan';
        $user['password'] = Hash::make($request->password);

        $new_user = User::create($user);
        if ($new_user) {
            event(new Registered($user));
            return redirect('/login')->with('success', 'Pendaftaran akun berhasil silahkan login');
        } else {
            return back()->with('error', 'Pendaftaran akun gagal');
        }
    }
}
