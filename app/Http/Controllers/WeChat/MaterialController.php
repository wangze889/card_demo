<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 17:10
 */

namespace App\Http\Controllers\WeChat;

//永久素材
use App\Helpers\Api\WeChatResponse;
use App\Http\Controllers\Upload\UploadImageController;
use Illuminate\Http\Request;

class MaterialController extends WeChatController
{
    protected $material;

    public function __construct()
    {
        parent::__construct();
        $this->material = $this->app->material;
    }

    public function uploadByType(Request $request)
    {
        $type = $request->input('type');
        $url = UploadImageController::uploadImg($type,$request);
        if($url){
            $local_path = 'uploads/'.$url;
            $res = $this->material->uploadImage(public_path($local_path));
            $res = WeChatResponse::handle($res);
            $res['data']['local_path'] = $local_path;
            return response()->json($res);
        }else{
            return $this->failed('上传失败');
        }
    }


}
