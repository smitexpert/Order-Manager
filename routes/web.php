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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');


Route::prefix('/add')->name('add')->group(function(){
    Route::get('/', 'AddOrderController@index');
    Route::post('/', 'AddOrderController@store')->name('.store');
});

Route::prefix('all')->name('all')->group(function(){
    Route::get('/', 'AllOrderController@index');
});

Route::prefix('pending')->name('pending')->group(function(){
    Route::get('/', 'PendingOrderController@index');
});

Route::get('/courier', 'CourierServiceController@index')->name('courier');

Route::post('/courier', 'CourierServiceController@store')->name('courier.store');
Route::get('/courier/{id}/delete', 'CourierServiceController@delete')->name('courier.delete');

Route::prefix('/shop')->name('shop')->group(function(){
    Route::get('/', 'ShopController@index');
    Route::post('/', 'ShopController@store')->name('.store');
    Route::get('/{id}/delete', 'ShopController@delete')->name('.delete');
});