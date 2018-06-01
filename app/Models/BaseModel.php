<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/29 0029
 * Time: 15:36
 */

namespace App\Models;


use App\Exceptions\BaseException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseModel extends Model
{
    protected $guarded = [];

    //    平台审核
    public function platformCheck(Request $request)
    {
        $id = $request->input('id');
        $model = $this->find($id);
        if(!$model){
            throw new BaseException('Model not found!');
        }
        $model->platform_check_status = $request->input('platform_check_status');
        if($request->input('reason')){
            $model->reason = $request->input('reason');
        }
        if($request->input('platform_check_status')==1){
            $model->reason = '';
        }
        $res =  $model->save();
        if($res){
            return $model;
        }else{
            return false;
        }
    }


}
