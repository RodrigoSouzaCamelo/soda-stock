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

Route::get('/', 'StockController@index');

Auth::routes();

Route::get('/stock', 'StockController@index')->name('stock.index');
Route::get('/soda', 'SodaController@index')->name('soda.index');

Route::get('/stock/store', 'StockController@store')->name('stock.store');
Route::get('/soda/store', 'SodaController@store')->name('soda.store');

Route::get('/stock/store/{sodaId}', 'StockController@addSodaInStock')->name('stock.add');

Route::post('/stock/create', 'StockController@create')->name('stock.create');
Route::post('/soda/create', 'SodaController@create')->name('soda.create');
