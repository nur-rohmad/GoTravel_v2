<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        if (!Auth::user()) {
            return view('auth.form_login');
        } else {
            $user = auth()->user();
            return redirect('/' . $user->role );
        }
    }

    public function procces_login(Request $request)
    {

        $data_login = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:6'
        ]);

        if (Auth::Attempt($data_login)) {
            $user = User::where('id', auth()->user()->id)->first();
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

     // redirect google login
     public function googleLogin(Request $request) {
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
                'password' => null,
                'email_verified_at' => now()
            ]);
            Auth::login($user);
            return redirect('pelanggan/');
        }else {
            Auth::login($user);
            return redirect('pelanggan/');
        }
        
    }

    public function logouth()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda Berhasil Logouth');
    }

}
