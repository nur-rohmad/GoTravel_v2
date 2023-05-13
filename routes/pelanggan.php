<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'pelanggan_role', 'namespace' => 'Pelanggan'], function () {
    Route::get('/', 'DashboardController@index');

    // wisata controller
    Route::group(['prefix' => 'wisata'], function () {
        Route::get('/', 'WisataController@index');
        Route::get('/{id}', 'WisataController@show');
    });
    // open-trip 
    Route::group(['prefix' => 'open-trip'], function () {
        Route::get('/', 'OpenTripController@index');
    });
    // booking
    Route::group(['prefix' => 'booking'], function () {
        Route::get('/', 'BookingController@index');
        Route::get('/detail/{id}', 'BookingController@detail');
        Route::get('/{slug}', 'BookingController@create');
        Route::post('/checkout', 'BookingController@checkout');
    });
    // invoice
    Route::get('/invoice/{id}', 'InvoiceController@show');
});
