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
use Illuminate\Support\Facades\DB;

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

    public function photos()
    {
        return $this->hasMany('App\Models\PoiPhotoList', 'poi_id', 'id');
    }

//    接收创建的字段保存数据表等待审核
    public function createPoi(Request $request)
    {
        $attributes = $request->only($this->create_keys);
        $res = self::create($attributes);
        $poi_id = $res->id;
        $photo_id_list = $request->input('photo_id_list');
        $photo_id_list = explode(',',$photo_id_list);
        DB::table('poi_photo_lists')->whereIn('id',$photo_id_list)->update(['poi_id'=>$poi_id]);
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

//  更新微信审核信息
    public static function updateWeChatCheckResult($message)
    {
        $poi_id = $message['PoiId'];
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

        self::where('poi_id','=',$poi_id)->update($info);

    }


}