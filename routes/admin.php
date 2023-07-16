<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'middleware' => ['admin_role']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/get-grafik', 'DashboardController@getDataGrafik');
    Route::get('/open-trip-besSelling', 'DashboardController@openTripBesSelling');
    // route untuk wisata
    Route::group(['prefix' => 'wisata'], function () {
        Route::get('/', 'WisataController@index');
        Route::get('/tambah-wisata', 'WisataController@create');
        Route::post('/proccess-add-wisata', 'WisataController@procces_create');
        Route::post('/proccess-edit-wisata', 'WisataController@procces_edit');
        Route::get('/edit-wisata/{id}', 'WisataController@edit');
        Route::post('/delete', 'WisataController@delete');
    });

    // open-trip
    Route::group(['prefix' => 'open-trip'], function () {
        Route::get('/', 'OpenTripController@index');
        Route::get('/tambah-open-trip', 'OpenTripController@create');
        Route::post('/proccess-add', 'OpenTripController@prosesCreate');
        Route::get('/show/{slug}', 'OpenTripController@show');
        Route::get('/edit/{slug}', 'OpenTripController@edit');
        Route::post('/proccess-edit', 'OpenTripController@proccess_edit');
        Route::post('/delete', 'OpenTripController@delete');
    });

    // chanel pembayaran
    Route::group(['prefix' => 'chanel-pembayaran'], function () {
        Route::get('/', 'ChanelPembayaranController@index');
        Route::post('/', 'ChanelPembayaranController@create');
        Route::post('/edit', 'ChanelPembayaranController@update');
    });

    // booking
    Route::group(['prefix' => 'booking'], function () {
        Route::get('/', 'BookingController@index');
        Route::get('/detail/{id}', 'BookingController@detail');
    });

    // laporan
    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', 'LaporanController@index');
    });

    Route::get('/user', 'UserController@index');
    Route::post('/user/edit', 'UserController@update');
    Route::post('/user/delete', 'UserController@delete');

    Route::get('/ticket', function () {
        return view('ticket');
    });
});
