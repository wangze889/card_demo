<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/31 0031
 * Time: 13:54
 */

namespace App\Models;


use App\Exceptions\BaseException;
use App\Helpers\Api\WeChatResponse;
use Illuminate\Http\Request;
use EasyWeChat;

class Poi extends BaseModel
{

    //    新增时接收的字段
    private $create_keys = [
        'merchant_id',
        'business_name',
        'branch_name',
        'province',
        'city',
        'district',
        'address',
        'telephone',
        'categories',
        'offset_type',
        'longitude',
        'latitude',
        'photo_list',
        'photo_local_path_list',
        'recommend',
        'special',
        'introduction',
        'open_time',
        'avg_price',
    ];

//   推送给微信的字段
    private $create_wechat_keys = [
        'business_name',
        'branch_name',
        'province',
        'city',
        'district',
        'address',
        'telephone',
        'categories',
        'offset_type',
        'longitude',
        'latitude',
        'photo_list',
        'recommend',
        'special',
        'introduction',
        'open_time',
        'avg_price'
    ];

    //微信返回后补全的字段
    private $complete_keys = [
        'merchant_id',
        'begin_time',
        'create_time',
        'update_time'
    ];

//    接收创建的字段保存数据表等待审核
    public function createPoi(Request $request)
    {
        $attributes = $request->only($this->create_keys);
        $res = self::create($attributes);
        return $res;
    }

//  推送至微信
    public function createToWeChat(Request $request)
    {
        $poi = self::find($request->input('id'));
        if(!$poi){
            throw new BaseException('Model not found!');
        }
        if($poi->platform_check_status!=1){
            throw new BaseException('平台审核尚未通过!');
        }
        $info = $poi->only($this->create_wechat_keys);
        $data = EasyWeChat::officialAccount()->poi->create($info);
        WeChatResponse::handleFail($data);
//        微信返回信息后补充字段
        $poi_id = $data['poi_id'];
        $data = array_merge(compact($poi_id),['wx_check_status'=>0]);
//        $data =
        $res = self::where('id','=',$request->input('id'))->update($data);
        return $res;
    }



}
