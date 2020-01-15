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

Route::get('customer', 'CustomerController@index');
Route::post('customer/store', 'CustomerController@store');
Route::put('/customer/update/{nama}', 'CustomerController@update');
Route::post('/customer/delete/{nama}', 'CustomerController@destroy');
Route::get('/customer/get/{nama}', 'CustomerController@get');
