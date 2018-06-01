<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/28 0028
 * Time: 18:07
 */

namespace App\Models;


use Illuminate\Http\Request;

class MerchantCheckResult extends BaseModel
{
//    处理审核信息
    public function handleCheckInfo($message)
    {

//    记录审核信息表
        self::create($message);
//        更新商户微信审核字段
        Merchant::updateWeChatCheckResult($message);

    }



}
