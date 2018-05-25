<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 11:03
 */

namespace App\Http\Controllers\WeChat;


use App\Exceptions\BaseException;
use App\Helpers\Api\WeChatResponse;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Upload\UploadImageController;
use Illuminate\Http\Request;

class MerchantsController extends CardsController
{
    public $merchant;

    public function __construct()
    {
        parent::__construct();
        $this->merchant = $this->card->sub_merchant;
    }

//    上传商户授权函图片
    public function uploadProtocolImg(Request $request)
    {
        $url = UploadImageController::uploadImg('protocol',$request);
        if($url){
            $data = $this->app->media->uploadImage(public_path('uploads/'.$url));
            return WeChatResponse::handle($data);
        }else{
            return $this->failed('上传失败');
        }
    }

//  上传商户logo
    public function uploadLogo(Request $request)
    {
        $url = UploadImageController::uploadImg('merchant_logo',$request);
        if($url){
            $data = $this->app->material->uploadImage(public_path('uploads/'.$url));
            return WeChatResponse::handle($data);
        }else{
            return $this->failed('上传失败');
        }
    }


//  获取授权函图片
    public function getProtocolImgByMediaId($mediaId)
    {
        $stream = $this->app->media->get($mediaId);
        $savePath = public_path('uploads/protocol/download/'.date('Ymd'));
        $res = $stream->save($savePath);
        if($res){
            return $res;
        }else{
            return false;
        }
    }




}
