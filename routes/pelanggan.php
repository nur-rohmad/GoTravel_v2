<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'pelanggan_role', 'namespace' => 'pelanggan'], function () {
    Route::get('/', 'DashboardController@index');

    // wisata controller
    Route::group(['prefix' => 'wisata'], function () {
        Route::get('/', 'WisataController@index');
    });
    // open-trip 
    Route::group(['prefix' => 'open-trip'], function(){
        Route::get('/','OpenTripController@index');
    });
    // booking
    Route::group(['prefix' => 'booking'], function(){
        Route::get('/{slug}', 'BookingController@create');
    });
});
