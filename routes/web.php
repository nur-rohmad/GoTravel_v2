<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@login')->name('login');
    Route::post('/proces-login', 'LoginController@procces_login');
    Route::get('/register', function () {
        return view('auth.form_register');
    });
    Route::post('/register', 'LoginController@register');
    Route::get('/logouth', 'LoginController@logouth')->middleware('auth');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'ProfileController@index');
    Route::post('/update-password', 'ProfileController@updatePassword');
    Route::post('/update-profile', 'ProfileController@updateProfile');
});

Route::get('/midtrans', function () {
    $invoice = Invoice::all();
    dd($invoice);
});

// Auth::routes(['verify' => true]);
