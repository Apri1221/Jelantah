<?php

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


Route::get('/', 'HomeController@index')->name('home');
Route::post('/register', 'CustomerController@store')->name('register');
Route::post('/login', 'CustomerController@login')->name('login');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard/device', 'DashboardController@device')->name('device');