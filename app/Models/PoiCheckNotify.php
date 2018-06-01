<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/6/1 0001
 * Time: 10:41
 */

namespace App\Models;


class PoiCheckNotify extends BaseModel
{

//    处理审核信息
    public function handleCheckNotify($message)
    {
        return $message;
//    记录审核信息表
        self::create($message);
//        更新商户微信审核字段
        Poi::updateWeChatCheckResult($message);

    }
}
