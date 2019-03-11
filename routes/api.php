<?php

use Illuminate\Http\Request;

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

Route::post('/authenticate', "UserController@authenticate");
Route::middleware('auth:admin')->post('user/store/{role}', "UserController@store")->where(['role' => '[1-3]+']);
Route::middleware('auth:seller')->post('product/store', "ProductController@store");
Route::middleware('auth:customer')->post('product/getList/{radius}', "ProductController@getList");
Route::middleware('auth:customer')->post('order/store/{product_id}', "OrderController@store")->where(['product_id' => '[0-9]+']);
