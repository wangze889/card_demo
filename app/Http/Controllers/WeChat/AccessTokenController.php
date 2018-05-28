<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/28 0028
 * Time: 17:03
 */

namespace App\Http\Controllers\WeChat;


class AccessTokenController extends WeChatController
{
    protected $access_token;

    public function __construct()
    {
        parent::__construct();
        $this->access_token = $this->app->access_token;
    }

    public function getToken()
    {
        return $this->access_token->getToken()['access_token'];
    }

    public function getTokenForceFromServer()
    {
        return $this->access_token->getToken(true)['access_token'];
    }
}
