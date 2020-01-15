<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('pengguna', 'PenggunaController@index');
Route::post('pengguna/create', 'PenggunaController@create');
Route::put('/pengguna/update/{nama}', 'PenggunaController@update');
Route::post('/pengguna/delete/{nama}', 'PenggunaController@delete');
Route::get('/pengguna/get/{nama}', 'PenggunaController@get');