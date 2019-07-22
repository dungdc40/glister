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

Auth::routes();

Route::get('/', 'CustomerController@index')->name('home');
Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePassword.get');;
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

Route::resource('customers', 'CustomerController');

Route::resource('orders', 'OrderController')->except(['create']);
Route::get('orders/create/{customer_tel?}', 'OrderController@create')->name('orders.create');

Route::post('import', 'CustomerController@import')->name('import');
Route::get('import-export', 'CustomerController@importExport');