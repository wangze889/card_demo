<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/30 0030
 * Time: 15:12
 */

namespace App\Http\Controllers\WeChatPush;


class VideoMessageHandler extends PushHandler
{
    public function reply()
    {
        return "这是视频信息";
    }


}
