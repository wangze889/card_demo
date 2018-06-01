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
use App\Http\Controllers\WeChatPush\PushHandler;
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
//        自动回复
        $this->app->server->push(PushHandler::class);

        return $this->app->server->serve();

    }






}
