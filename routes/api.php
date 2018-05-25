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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/wechat/token','WeChat\WeChatController@token');
//Route::post('/upload/{type}',"Upload\UploadImageController@uploadImg");
Route::post('/protocol/upload',"WeChat\MerchantsController@uploadProtocolImg");
Route::get('/protocol/get/{mediaId}',"WeChat\MerchantsController@getProtocolImgByMediaId");
Route::post('/merchant/logo/upload','WeChat\MerchantsController@uploadLogo');

