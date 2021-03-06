<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/31 0031
 * Time: 17:52
 */

namespace App\Http\Controllers\WeChat;


use App\Helpers\Api\ApiResponse;
use App\Http\Controllers\Api\ApiController;
use App\Models\BaseModel;
use Illuminate\Http\Request;

trait CheckTrait
{
    //    平台审核
    public function platformCheck(BaseModel $model, Request $request)
    {
//        $merchant = new Merchant();
        $res =  $model->platformCheck($request);
        if($res){
            return (new ApiController())->success('操作成功',$res);
        }else{
            return (new ApiController())->failed('操作失败');
        }
    }



}
