<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 11:01
 */

namespace App\Http\Controllers\WeChat;



class CardsController extends WeChatController
{
    public $card;

    public function __construct()
    {
        parent::__construct();

        $this->card = $this->app->card;
    }


}
