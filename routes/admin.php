<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'admin'], function () {
    Route::get('/dashboard', 'DashboardController@index');
    // route untuk wisata
    Route::group(['prefix' => 'wisata'], function () {
        Route::get('/', 'WisataController@index');
        Route::get('/tambah-wisata', 'WisataController@create');
        Route::post('/proccess-add-wisata', 'WisataController@procces_create');
        Route::post('/proccess-edit-wisata', 'WisataController@procces_edit');
        Route::get('/edit-wisata/{id}', 'WisataController@edit');
        Route::post('/delete', 'WisataController@delete');
    });
});
