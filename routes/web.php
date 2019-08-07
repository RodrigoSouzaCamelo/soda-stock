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

// STOCK
Route::get('/stock', 'StockController@index')->name('stock.index');
Route::get('/stock/store', 'StockController@store')->name('stock.store');
Route::get('/stock/store/{sodaId}', 'StockController@addSodaInStock')->name('stock.add');
Route::post('/stock/create', 'StockController@create')->name('stock.create');

// SODA
Route::get('/soda', 'SodaController@index')->name('soda.index');
Route::get('/soda/store', 'SodaController@store')->name('soda.store');
Route::post('/soda/create', 'SodaController@create')->name('soda.create');

// BRAND
Route::get('/brand', 'BrandController@index')->name('brand.index');

Route::get('/brand/store', 'BrandController@store')->name('brand.store');
Route::post('/brand/create', 'BrandController@create')->name('brand.create');

Route::get('/brand/edit/{brandId}', 'BrandController@edit')->name('brand.edit');
Route::post('/brand/update/{brandId}', 'BrandController@update')->name('brand.update');

Route::get('/brand/{brandId}', 'BrandController@deleteById')->name('brand.delete');
Route::get('/brand/delete/array/{BrandId}', 'BrandController@deleteByArrayId')->name('brand.delete.array');