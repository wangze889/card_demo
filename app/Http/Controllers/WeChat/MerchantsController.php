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

//子商户控制器
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
        return (new MediaController())->uploadByType('protocol');
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

//  上传商户logo
    public function uploadLogo(Request $request)
    {
        return (new MaterialController())->uploadByType($request);
    }

//  上传营业执照或个体工商户营业执照彩照或扫描件
    public function uploadAgreement(Request $request)
    {
        return (new MaterialController())->uploadByType($request);
    }

//上传营业执照内登记的经营者身份证彩照或扫描件
    public function upLoadOperator(Request $request)
    {
        return (new MaterialController())->uploadByType($request);
    }


}
