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

Route::get('customer', 'customerController@index');
Route::post('customer/store', 'customerController@store');
Route::put('/customer/update/{nama}', 'customerController@update');
Route::post('/customer/delete/{nama}', 'customerController@destroy');
Route::get('/customer/get/{nama}', 'customerController@get');
