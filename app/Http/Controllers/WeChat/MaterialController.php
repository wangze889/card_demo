<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 17:10
 */

namespace App\Http\Controllers\WeChat;


class MaterialController extends WeChatController
{
    protected $material;

    public function __construct()
    {
        parent::__construct();
        $this->material = $this->app->material;
    }


}
