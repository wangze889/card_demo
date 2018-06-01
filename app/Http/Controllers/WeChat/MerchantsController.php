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
use App\Models\BaseModel;
use App\Models\Merchant;
use App\Models\MerchantCheckResult;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

//子商户控制器
class MerchantsController extends CardsController
{
    use CheckTrait;

    public $merchant;

    public function __construct()
    {
        parent::__construct();
        $this->merchant = $this->card->sub_merchant;
    }


//  创建商户，等待平台审核
    public function create(Request $request)
    {
        $merchant = new Merchant();
        $res = $merchant->createMerchant($request);
        if($res){
            return $this->success('创建成功',$res->toArray());
        }else{
            $this->failed('上传失败');
        }
    }

//    平台审核
    public function platformCheckMerchant(Request $request)
    {
        $merchant = new Merchant();
        return $this->platformCheck($merchant,$request);
    }

//    向微信端提交创建申请
    public function pushCreateToWeChat(Request $request)
    {
        $merchant = new Merchant();
        return $merchant->createToWeChat($request);
    }


//  分页拉取列表
    public function lst()
    {
        return Merchant::orderBy('id','desc')->get();
    }

//    获取子商户总数
    public function sum()
    {
        return Merchant::count();
    }



//获取单个商户信息
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

//




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
