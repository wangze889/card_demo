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

Route::any('wechat/serve',"WeChat\WeChatController@serve");

Route::get('wechat/token','WeChat\AccessTokenController@getToken');
//Route::post('/upload/{type}',"Upload\UploadImageController@uploadImg");
Route::post('/protocol/upload',"WeChat\MerchantsController@uploadProtocolImg");
Route::get('/protocol/get/{mediaId}',"WeChat\MerchantsController@getProtocolImgByMediaId");
Route::post('/merchant/logo/upload','WeChat\MerchantsController@uploadLogo');


//上传素材
Route::post('material/upload','Wechat\MaterialController@uploadByType');
Route::post('media/upload','Wechat\MediaController@uploadByType');

//子商户

Route::group(['prefix'=>'merchant'],function (){
    Route::get('list','WeChat\MerchantsController@lst');
//    Route::post('create','WeChat\MerchantsController@create');
    Route::get('count','WeChat\MerchantsController@sum');
    Route::post('get','WeChat\MerchantsController@getOneInfoByMerchantId');
    Route::post('platCheck','WeChat\MerchantsController@platformCheck');
    Route::post('push','WeChat\MerchantsController@createToWeChat');
    Route::post('create','WeChat\MerchantsController@add');
});


Route::post('test','WeChat\MerchantsController@test');
