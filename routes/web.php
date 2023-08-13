<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => ['auth']], function() {   
    //Route::get('/products','App\Http\Controllers\ProductController@index')->name('products.index');
    Route::get('/products','App\Http\Controllers\ProductController@search')->name('products.search');
    Route::get('/products/create','App\Http\Controllers\ProductController@create')->name('products.create');
    Route::post('/products/regist','App\Http\Controllers\ProductController@regist')->name('products.regist');
    Route::get('/products/edit/{id}','App\Http\Controllers\ProductController@edit')->name('products.edit');
    Route::put('/products/edit/{id}','App\Http\Controllers\ProductController@update')->name('products.update');
    Route::get('/products/show/{id}','App\Http\Controllers\ProductController@show')->name('products.show');
    Route::delete('/products/{product}','App\Http\Controllers\ProductController@destroy')->name('products.destroy');
    });