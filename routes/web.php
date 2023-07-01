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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('App\Http\Controllers')->middleware('cek.apikey')->group(function(){
    Route::get('login', 'PenggunaController@login');
    Route::delete('login', 'PenggunaController@login');

    Route::group(['prefix'=>'pengguna', 'middleware'=> ['cek.user']], function(){
        Route::patch('/', 'PenggunaController@update');
        Route::post('/photo', 'PenggunaController@simpan_photo');
        Route::get('/photo', 'PenggunaController@photo');
    });

    Route::prefix('pegawai')->middleware(['cek.user'])->group(function(){
        Route::post('/', 'PegawaiController@store');
        Route::patch('/{p}', 'PegawaiController@update');
        Route::delete('/{p}', 'PegawaiController@delete');
        Route::get('/{p}', 'PegawaiController@show');
    });
});