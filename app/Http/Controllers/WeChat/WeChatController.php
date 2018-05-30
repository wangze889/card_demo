<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/24 0024
 * Time: 14:13
 */

namespace App\Http\Controllers\WeChat;


use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WeChatPush\EventMessageHandler;
use App\Models\MerchantCheckResult;
use EasyWeChat;

class WeChatController extends ApiController
{
    protected $app;

    public function __construct()
    {
//        $this->app = EasyWeChat::officialAccount('test');
        $this->app = EasyWeChat::officialAccount();
    }


    public function serve()
    {
//        $this->app->server->push(function ($message) {
//            switch ($message['MsgType']) {
//                case 'event':
//                    if($message['Event']=='card_merchant_check_result'){
//                        $merchant = new MerchantCheckResult();
//                        $merchant->create($message);
//                        return "收到审核事件通知";
//                    }
//                    break;
//                case 'text':
//                    return '收到文字消息';
//                    break;
//                case 'image':
//                    return '收到图片消息';
//                    break;
//                case 'voice':
//                    return '收到语音消息';
//                    break;
//                case 'video':
//                    return '收到视频消息';
//                    break;
//                case 'location':
//                    return '收到坐标消息';
//                    break;
//                case 'link':
//                    return '收到链接消息';
//                    break;
//                case 'file':
//                    return '收到文件消息';
//                // ... 其它消息
//                default:
//                    return '收到其它消息';
//                    break;
//            }
//
//            // ...
//        });
        $this->app->server->push(EventMessageHandler::class);

        return $this->app->server->serve();

    }




}
