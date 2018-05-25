<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/24 0024
 * Time: 16:09
 */

namespace App\Http\Controllers\Upload;


use App\Exceptions\BaseException;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class UploadImageController extends UploadController
{
    public static function uploadImg($type, Request $request)
    {
        if(!$request->hasFile($type)){
            $data = ['code'=>'400','msg'=>'上传文件不存在'];
            throw new BaseException($data);
//            return response()->json($data,500);
        }
        $img = $request->file($type);

        // 使用 store 存储文件
        $path = $path = $img->store($type.'/'.date('Ymd'));
        if($path){
            return $path;
        }
        return false;
    }

}
