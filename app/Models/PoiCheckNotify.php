<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/6/1 0001
 * Time: 10:41
 */

namespace App\Models;


//门店审核推送
class PoiCheckNotify extends BaseModel
{
    protected $table = 'poi_check_notify';

//    处理审核信息
    public function handleCheckNotify($message)
    {
//    记录审核信息表
        $res = self::create($message);
//        更新商户微信审核字段
        Poi::updateWeChatCheckResult($message);

    }
}
