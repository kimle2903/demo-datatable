<?php

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



Auth::routes();

Route::group(['group' => 'auth'], function(){
    Route::get('/', 'ConsomerController@index')->name('home');
    Route::get('customer/datatable', 'ConsomerController@getDataTable')->name('customer.datatable');
    Route::get('customer/detail/{id}', 'ConsomerController@detail')->name('customer.detail');
    Route::post('customer/change-status', 'ConsomerController@changeStatus')->name('customer.change.status');
});

