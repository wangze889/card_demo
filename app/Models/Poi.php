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
        'recommend',
        'special',
        'introduction',
        'open_time',
        'avg_price',
        'photo_list'
    ];

    //微信返回后补全的字段
    private $complete_keys = [
        'merchant_id',
        'begin_time',
        'create_time',
        'update_time'
    ];

    public function photo_list()
    {
        return $this->hasMany('App\Models\PoiPhotoList', 'poi_id', 'id');
    }


//    接收创建的字段保存数据表等待审核
    public function createPoi(Request $request)
    {
        $attributes = $request->only($this->create_keys);
        $attributes = array_merge($attributes,['merchant_id'=>1]);
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
        $id = $request->input('id');
        $poi = self::find($id);
        if(!$poi){
            throw new BaseException('Model not found!');
        }
        if($poi->platform_check_status!=1){
            throw new BaseException('平台审核尚未通过!');
        }
//        处理categories
        $poi->categories = (array)($poi->categories);
//        过滤字段
        $info = $poi->only($this->create_wechat_keys);
//        获取照片列表
        $photo_list = PoiPhotoList::getPhotosByPoiId($id)->toArray();
        $info = array_merge($info,compact('photo_list'));
//        dd($info);
        $data = EasyWeChat::officialAccount()->poi->create($info);
//        return $data;
        WeChatResponse::handleFail($data);
//        微信返回信息后补充字段
        $poi_id = $data['poi_id'];
        $data = array_merge(compact('poi_id'),['wx_check_status'=>0]);
//        dd($data);

        $res = self::where('id','=',$id)->update($data);
        return $res;
    }

//  更新微信审核信息
    public static function updateWeChatCheckResult($message)
    {
        $poi_id = $message['PoiId'];
        $is_pass = $message['Result'];
        if(array_key_exists('msg',$message)){
            $reason = $message['msg'];
        }else{
            $reason = '';
        }
        switch ($is_pass){
            case 'fail':
                $wx_check_status = 2;
                break;
            case 'succ':
                $wx_check_status = 1;
                break;
        }
        $info = compact('wx_check_status','reason');

        self::where('poi_id','=',$poi_id)->update($info);

    }


}
