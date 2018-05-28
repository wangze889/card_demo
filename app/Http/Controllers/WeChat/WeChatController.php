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
        $this->app->server->push(function($message){
            return "Here is the card demo！";
        });

        return $this->app->server->serve();

    }

    public function test()
    {
        return "this is test";
    }



}
