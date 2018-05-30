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
    public $timestamps = false;

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

//    平台审核商户
    public function platformCheck(Request $request)
    {
        $id = $request->input('id');
        $merchant = self::find($id);
        if(!$merchant){
            throw new BaseException('Model not found!');
        }
        $merchant->platform_check_status = $request->input('platform_check_status');
        if($request->input('reason')){
            $merchant->reason = $request->input('reason');
        }
        $res =  $merchant->save();
        if($res){
            return $merchant;
        }else{
            return false;
        }
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
        $data = collect($data)->only($this->complete_keys);
        $data = array_merge($data,['reason'=>'']);
        $res = self::where('id','=',$request->input('id'))->update($data);
        return $res;
    }



//    微信返回信息后补充字段
    public function completeAfterPushWeChat(Request $request)
    {

    }

}
