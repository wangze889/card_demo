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
use GuzzleHttp\Client;
use Illuminate\Http\Request;

//子商户控制器
class MerchantsController extends CardsController
{
    public $merchant;

    const info_keys = [
        'app_id', 'brand_name', 'logo_url', 'protocol', 'end_time', 'primary_category_id', 'secondary_category_id', 'agreement_media_id', 'operator_media_id'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->merchant = $this->card->sub_merchant;
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

    public function create(Request $request)
    {
        $attributes = $request->only(self::info_keys);
        $attributes['end_time'] = strtotime($attributes['end_time']);
        return $this->merchant->create($attributes);
    }

    public function getOneInfoByMerchantId(Request $request)
    {
        $merchant_id = $request->input('merchant_id');
        $access_token = (new AccessTokenController())->getToken();
        $client = new Client();
        $data = $client->post("https://api.weixin.qq.com/card/submerchant/get?access_token=$access_token", ['json'=>['merchant_id' => $merchant_id]]);
        $data = json_decode($data->getBody(),true);
        $res = WeChatResponse::handle($data);
        return $this->respond($res);
    }

}
