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
    return view('index');
});

Route::get('/siswa', 'SiswaController@index');
Route::get('/siswa/add', 'SiswaController@add');
Route::get('/siswa/add/{id}', 'SiswaController@edit');
Route::post('/siswa/store', 'SiswaController@store');
Route::post('/siswa/update/{id}', 'SiswaController@update');
Route::delete('/siswa/delete/{id}', 'SiswaController@delete');

Route::get('/pegawai', 'PegawaiController@index');
Route::get('/pegawai/add', 'PegawaiController@add');
Route::get('/pegawai/add/{id}', 'PegawaiController@edit');
Route::post('/pegawai/store', 'PegawaiController@store');
Route::post('/pegawai/update/{id}', 'PegawaiController@update');
Route::delete('/pegawai/delete/{id}', 'PegawaiController@delete');

Route::get('/pegawai/loadData', 'PegawaiController@loadData');
Route::get('/pegawai/{id}', 'PegawaiController@detail');