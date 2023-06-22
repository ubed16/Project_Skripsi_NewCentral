<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\Product;
use App\Http\Controllers\Api\Master;
use App\Http\Controllers\Api\ItemApiController;
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
Route::post('get-customer',[Admin::class,'getCustomer']);
Route::post('get-product',[Product::class,'getProduct']);
Route::post('get-master',[Master::class,'getMaster']);
Route::post('get-item',[ItemApiController::class,'getItem']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
