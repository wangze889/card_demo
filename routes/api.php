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
    Route::post('create','WeChat\MerchantsController@create');
    Route::get('count','WeChat\MerchantsController@sum');
    Route::post('get','WeChat\MerchantsController@getOneInfoByMerchantId');
    Route::post('platCheck','WeChat\MerchantsController@platformCheckMerchant');
    Route::post('push','WeChat\MerchantsController@pushCreateToWeChat');

});

//门店

Route::group(['prefix'=>'poi'],function (){
    Route::get('list','WeChat\PoiController@lst');
    Route::get('get/{id}','WeChat\PoiController@get');

    Route::post('uploadPhoto','WeChat\PoiController@uploadPoiPhoto');
    Route::post('create','WeChat\PoiController@create');
    Route::get('count','WeChat\PoiController@sum');
    Route::post('platCheck','WeChat\PoiController@platformCheckPoi');
    Route::post('push','WeChat\PoiController@pushCreateToWeChat');


    Route::get('weChatList/{from}/{limit}', 'WeChat\PoiController@getListFromWeChat');
    Route::delete('delete/{poiId}','WeChat\PoiController@deleteByPoiId');
    Route::patch('edit','WeChat\PoiController@edit');

});


Route::post('test','WeChat\MerchantsController@test');
