<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/28 0028
 * Time: 9:48
 */

namespace App\Helpers\Api;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Response;

trait ApiResponse
{
    protected $code = FoundationResponse::HTTP_OK;
    protected $errorCode = 0;
    protected $msg = 'success';

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {

        $this->code = $code;
        return $this;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    public function respond($response, $header = [])
    {
        return Response::json($response,$this->getCode(),$header);
    }

    public function message($msg, $data = null, $code = null, $errorCode = null)
    {
        if ($code){
            $this->setCode($code);
        }
        if($errorCode){
            $this->setErrorCode($errorCode);
        }
        $this->setMsg($msg);
        $res = [
            'msg' => $this->msg,
            'code' => $this->code,
            'errorCode' => $this->errorCode
        ];

        if($data){
            if($data instanceof Collection){
                $data = $data->toArray();
            }
            $res = array_merge($res, compact('data'));
        }
        return $this->respond($res);
    }


    public function failed($msg, $code = FoundationResponse::HTTP_BAD_REQUEST, $errorCode = 10000)
    {
        return $this->message($msg,null, $code, $errorCode);
    }


    public function success($msg, $data = null ,$code = FoundationResponse::HTTP_OK, $errorCode = 0 )
    {
        return $this->message($msg, $data, $code, $errorCode);
    }
}
