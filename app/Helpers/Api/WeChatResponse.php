<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 16:08
 */

namespace App\Helpers\Api;


use App\Exceptions\BaseException;
use App\Http\Controllers\Controller;

Class WeChatResponse extends Controller
{
    protected $code;
    protected $msg;
    protected $errorCode;
    protected $data;

//    处理微信返回的数据
    public static function handle($data){
        if(array_key_exists('errcode',$data)&&$data['errcode'] != 0) {
            self::fail($data);
        }
        return self::success($data);
    }

//    如果失败抛出异常
    public static function handleFail($data)
    {
        if(array_key_exists('errcode',$data)&&$data['errcode'] != 0) {
            self::fail($data);
        }
    }


    public static function success($data)
    {
        $res['code'] = 200;
        $res['errorCode'] = 0;
        $res['data'] = $data['info'];
        return $res;

    }

    public static function fail($data)
    {
        $res['code'] = 400;
        $res['errorCode'] = $data['errcode'];
        $res['msg'] = $data['errmsg'];
        throw new BaseException($res);
    }
}
