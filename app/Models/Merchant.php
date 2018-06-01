<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 12:06
 */

namespace App\Models;


use App\Exceptions\BaseException;
use App\Helpers\Api\WeChatResponse;
use App\Http\Controllers\WeChat\WeChatController;
use Illuminate\Http\Request;
use EasyWeChat;

class Merchant extends BaseModel
{

//    新增时接收的字段
    private $create_keys = [
        'brand_name',
        'logo_url',
        'logo_local_path',
        'protocol',
        'protocol_local_path',
        'end_time',
        'primary_category_id',
        'secondary_category_id',
        'agreement_media_id',
        'agreement_local_path',
        'operator_media_id',
        'operator_local_path',
        'app_id'
    ];

//  推送给微信的字段
    private $create_wechat_keys = [
        'brand_name',
        'logo_url',
        'protocol',
        'end_time',
        'primary_category_id',
        'secondary_category_id',
        'agreement_media_id',
        'operator_media_id',
        'app_id'
    ];

//微信返回后补全的字段
    private $complete_keys = [
        'merchant_id',
        'begin_time',
        'create_time',
        'update_time'
    ];


//    新增商户
    public function createMerchant(Request $request)
    {
        $attributes = $request->only($this->create_keys);
        $attributes['end_time'] = strtotime($attributes['end_time']);
        $res = $this->create($attributes);
        return $res;
    }



//    推送至微信
    public function createToWeChat(Request $request)
    {
        $merchant = self::find($request->input('id'));
        if(!$merchant){
            throw new BaseException('Model not found!');
        }
        if($merchant->platform_check_status!=1){
            throw new BaseException('平台审核尚未通过!');
        }
        $info = $merchant->only($this->create_wechat_keys);
        $data = EasyWeChat::officialAccount()->card->sub_merchant->create($info);
        WeChatResponse::handleFail($data);
//        微信返回信息后补充字段
        $data = collect($data['info'])->only($this->complete_keys)->toArray();
        $data = array_merge($data,['wx_check_status'=>0]);
        $res = self::where('id','=',$request->input('id'))->update($data);
        return $res;
    }


//  更新微信审核信息
    public static function updateWeChatCheckResult($message)
    {
        $merchant_id = $message['MerchantId'];
        $is_pass = $message['IsPass'];
        if(array_key_exists('Reason',$message)){
            $reason = $message['Reason'];
        }else{
            $reason = '';
        }
        switch ($is_pass){
            case 0:
                $wx_check_status = 2;
                break;
            case 1:
                $wx_check_status = 1;
                break;
        }
        $info = compact('wx_check_status','reason');

        self::where('merchant_id','=',$merchant_id)->update($info);

    }



}
