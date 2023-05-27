<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::group(['middleware' => ['pelanggan_role', 'verified'], 'namespace' => 'Pelanggan'], function () {
    Route::get('/', 'DashboardController@index');

    // wisata controller
    Route::group(['prefix' => 'wisata'], function () {
        Route::get('/', 'WisataController@index');
        Route::get('/{id}', 'WisataController@show');
    });
    // open-trip 
    Route::group(['prefix' => 'open-trip'], function () {
        Route::get('/', 'OpenTripController@index');
        Route::get('/{slug}', 'OpenTripController@show');
    });
    // booking
    Route::group(['prefix' => 'booking'], function () {
        Route::get('/', 'BookingController@index');
        Route::get('/detail/{id}', 'BookingController@detail');
        Route::get('/{slug}', 'BookingController@create');
        Route::post('/checkout', 'BookingController@checkout');
        Route::get('/cetak-tiket/{id_booking}', 'BookingController@cetakTiket');
    });
    // invoice
    Route::get('/invoice/{id}', 'InvoiceController@show');
    Route::get('/get-secadule', 'DashboardController@getSecadue');
});
