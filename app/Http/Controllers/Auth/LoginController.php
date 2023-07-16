<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login()
    {
        if (!Auth::user()) {
            return view('auth.form_login');
        } else {
            $user = auth()->user();
            return redirect('/' . $user->role);
        }
    }

    public function procces_login(Request $request)
    {

        $data_login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $user_login = User::where('email', $request->email)->whereNull('deleted_at')->first();
        if (!$user_login) {
            return back()->with('error', 'user tidak ditemukan');
        }
        if (Auth::Attempt($data_login)) {
            $user = User::where('id', auth()->user()->id)->whereNull('deleted_at')->first();
            if (!$user) {
                return back()->with('error', 'user tidak ditemukan');
            }
            $user->last_login = now();
            $user->save();
            $request->session()->regenerate();
            switch (auth()->user()->role) {
                case 'admin':
                    return redirect('admin/');
                    break;
                case 'pelanggan':
                    return redirect('pelanggan/');
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

    // redirect google login
    public function googleLogin(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackOauth(Request $request)
    {
        $user_google = Socialite::driver('google')->user();

        $user = User::where('email', $user_google->getEmail())->first();
        if ($user === null) {
            $user =  User::create([
                'email' => $user_google->getEmail(),
                'name' => $user_google->getName(),
                'role' => 'pelanggan',
                'status' => 1,
                'password' => null
            ]);
            Auth::login($user);
            return redirect('pelanggan/');
        } else {
            Auth::login($user);
            return redirect('pelanggan/');
        }
    }
}
