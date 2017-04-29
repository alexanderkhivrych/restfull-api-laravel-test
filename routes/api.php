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
Route::patch('product/unbind-voucher/{productId}/{voucherId}', 'Api\ProductController@unbindVoucher');
Route::patch('product/bind-voucher/{productId}/{voucherId}', 'Api\ProductController@bindVoucher');

Route::resource('product', 'Api\ProductController');
Route::resource('voucher', 'Api\VoucherController');
