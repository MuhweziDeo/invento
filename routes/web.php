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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'is_staff']], function () {
    Route::resource('users', 'User\UserController');
    Route::resource('items', 'Item\ItemController');
    Route::resource('sales', 'Sale\SaleController');
    Route::resource('services', 'Service\ServiceController');
});
