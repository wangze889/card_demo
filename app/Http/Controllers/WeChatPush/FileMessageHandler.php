<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/30 0030
 * Time: 15:48
 */

namespace App\Http\Controllers\WeChatPush;


class FileMessageHandler extends PushHandler
{
    public function reply()
    {
        return "这是文件信息";
    }


}
