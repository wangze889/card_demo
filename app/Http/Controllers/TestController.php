<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/6/7 0007
 * Time: 10:36
 */

namespace App\Http\Controllers;


use App\Models\PoiPhotoList;
use App\Models\Test;
use Carbon\Carbon;

class TestController extends Controller
{

//
    public function mysqlJsonTest()
    {
//        $data = [
//            'meta'=>[
//                "asd","asd","fufj"
//            ]
//        ];
//        $data['meta'] = json_encode($data['meta']);
//        return Test::create($data);

//        $data = Test::where('meta->a','=','apple')->get();
//        dump($data->toArray());

        $data = PoiPhotoList::find(1);
        return $data->created_at->getTimestamp();
//        $data->updated_at = strtotime($data->created_at);
//        return $data;
    }

}
