<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/30 0030
 * Time: 15:13
 */

namespace App\Http\Controllers\WeChatPush;


class LocationMessageHandler extends PushHandler
{
    public function reply()
    {
        return "这是位置信息";
    }


}
