<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 16:47
 */

namespace App\Http\Controllers\WeChat;

//临时素材
use App\Http\Controllers\Upload\UploadImageController;
use Illuminate\Http\Request;

class MediaController extends WeChatController
{
    protected $media;

    public function __construct()
    {
        parent::__construct();
        $this->media = $this->app->media;
    }

    public function uploadByType(Request $request)
    {
        $type = $request->input('type');
        $url = UploadImageController::uploadImg($type,$request);
        if($url){
            $data = $this->media->uploadImage(public_path('uploads/'.$url));
            return WeChatResponse::handle($data);
        }else{
            return $this->failed('上传失败');
        }
    }


}
