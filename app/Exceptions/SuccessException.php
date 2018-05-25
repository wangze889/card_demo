<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 15:34
 */

namespace App\Exceptions;


class SuccessException extends BaseException
{
    public $code = 200;
    public $msg = '操作成功';
    public $errorCode = 0;
}
