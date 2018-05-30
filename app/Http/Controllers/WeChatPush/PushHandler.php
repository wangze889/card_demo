<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/30 0030
 * Time: 14:59
 */

namespace App\Http\Controllers\WeChatPush;


use App\Http\Controllers\WeChat\WeChatController;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

class PushHandler extends WeChatController implements EventHandlerInterface
{
    protected $push_message;

    public function __construct()
    {
        $this->push_message = $this->app->server->getMessage();
    }

    public function handle($payload = null)
    {
//        $MsgType = $this->push_message['MsgType'];
//        $MsgType = $payload['MsgType'];
//        $className = ucfirst(strtolower($MsgType))."MessageHandler";
//        if(class_exists($className)){
//            $message_handler = new $className();
//            return $message_handler->reply($payload);
//        }else{
//            return '啊啊啊';
//        };
        return "啊哈哈";
    }
}
