<?php


use Illuminate\Support\Facades\Route; 

Route::group(['midleware'=> 'pelanggan_role', 'namespace' => 'pelanggan'], function() {
    Route::get('/', 'DashboardController@index');
});