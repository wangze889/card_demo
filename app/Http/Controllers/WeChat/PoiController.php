<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/31 0031
 * Time: 13:49
 */

namespace App\Http\Controllers\WeChat;


use App\Exceptions\BaseException;
use App\Helpers\Api\WeChatResponse;
use App\Http\Controllers\Upload\UploadImageController;
use App\Models\Poi;
use App\Models\PoiCheckNotify;
use App\Models\PoiPhotoList;
use Illuminate\Http\Request;

class PoiController extends WeChatController
{
    use CheckTrait;
    public $poi;

    public function __construct()
    {
        parent::__construct();
        $this->poi = $this->app->poi;
    }

//    创建门店，等待审核
    public function create(Request $request)
    {
        $poi = new Poi();
        $res = $poi->createPoi($request);
        if($res){
            return $this->success('创建成功',$res);
        }else{
            return $this->failed('创建失败');
        }
    }

//    平台审核
    public function platformCheckMerchant(Request $request)
    {
        $poi = new Poi();
        return $this->platformCheck($poi,$request);
    }

//  向微信端提交创建申请
    public function pushCreateToWeChat(Request $request)
    {
        $poi = new Poi();
        $res =  $poi->createToWeChat($request);
        if($res){
            return $this->success('推送成功');
        }else{
            return $this->failed('操作失败');
        }
    }

    public function platformCheckPoi(Request $request)
    {
        $poi = new Poi();
        return $this->platformCheck($poi, $request);
    }

    //  分页拉取列表
    public function lst()
    {
        return Poi::with('photo_list')->orderBy('id','desc')->get();
    }

    public function get($id)
    {
        return Poi::with('photo_list')->find($id);
    }



    public function sum()
    {
        return Poi::count();
    }

//    上传门店图片

    /**
     * @param Request $request
     * @return PoiPhotoList
     * @throws BaseException
     */
    public function uploadPoiPhoto(Request $request)
    {
        $url = UploadImageController::uploadImg('poi_photo',$request);
        if($url){
            $local_url = 'uploads/'.$url;
            $res = $this->app->material->uploadImage(public_path($local_url));
            WeChatResponse::handleFail($res);
            $photo_url = $res['url'];
            $data = array_merge(compact('local_url','photo_url'));
            $res = PoiPhotoList::create($data);
            if($res){
                return $res;
            }else{
                return $this->failed('上传失败');
            }
        }else{
            throw new BaseException('上传失败');
        }
    }

//    测试用修改接口
    public function edit(Request $request)
    {
        $poi_id = $request->input('poi_id');
        $data = $request->only((new Poi())->create_wechat_keys);
        return $this->poi->update($poi_id,$data);
    }

//        获取微信端门店列表
    public function getListFromWeChat($begin,$limit)
    {
        return $this->poi->list($begin,$limit);
    }

//    删除微信端门店
    public function deleteByPoiId($poiId)
    {
        return $this->poi->delete($poiId);
    }
}
