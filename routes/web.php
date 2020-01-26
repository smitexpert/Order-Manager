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
    Route::get('/{id}/charge',  'AddOrderController@charge')->name('.charge');
});

Route::prefix('all')->name('all')->group(function(){
    Route::get('/', 'AllOrderController@index');
    Route::get('/{id}/delete', 'AllOrderController@delete')->name('.delete');
    Route::post('/', 'AllOrderController@dateSearch')->name('.datesearch');
    Route::get('/{id}/get', 'AllOrderController@single')->name('.single');
    Route::get('/{id}/{status}/status', 'AllOrderController@status')->name('.status');
    Route::get('/{id}/{remark}/remark', 'AllOrderController@remark')->name('.remark');
    Route::get('/{id}/remark', 'AllOrderController@getRemark')->name('.remark.get');
    Route::get('/{id}/{method}/{amount}/{remindcode}/payment', 'AllOrderController@payment')->name('.payment');
    Route::get('/{id}/payments', 'AllOrderController@getPayments')->name('.payment.get');
});

Route::prefix('pending')->name('pending')->group(function(){
    Route::get('/', 'PendingOrderController@index');
    Route::get('/{id}/shipped', 'PendingOrderController@shipped')->name('.shipped');
});

Route::prefix('shipped')->name('shipped')->group(function(){
    Route::get('/', 'ShippedOrderController@index');
    Route::get('/{id}/print', 'ShippedOrderController@print')->name('.print');
});

Route::prefix('printed')->name('printed')->group(function(){
    Route::get('/', 'PrintedOrderController@index');
});

Route::get('/courier', 'CourierServiceController@index')->name('courier');

Route::post('/courier', 'CourierServiceController@store')->name('courier.store');
Route::get('/courier/{id}/delete', 'CourierServiceController@delete')->name('courier.delete');

Route::prefix('/shop')->name('shop')->group(function(){
    Route::get('/', 'ShopController@index');
    Route::post('/', 'ShopController@store')->name('.store');
    Route::get('/{id}/delete', 'ShopController@delete')->name('.delete');
    Route::post('/{id}/upload', 'ShopController@upload')->name('.upload');
    Route::get('/{id}/get', 'ShopController@get')->name('.get');
    Route::post('/update', 'ShopController@update')->name('.update');
});

Route::prefix('/image')->name('image')->group(function(){
    Route::get('/', 'ImageController@index');
    Route::post('/', 'ImageController@upload')->name('.upload');
});