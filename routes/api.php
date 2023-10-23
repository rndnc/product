<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

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
// Route::post('/apiSales','App\Http\Controllers\SaleController@apiSales');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['middleware' => 'api'])->group(function () {
    // API 商品の在庫数を減らす処理
    Route::post('/apiSales',[SaleController::class, 'apiSales']);
    // API 商品の在庫数を増やす処理
//     Route::post('/apiAdd',[SalesController::class, 'apiAdd']);
});
