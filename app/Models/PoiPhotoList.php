<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/6/1 0001
 * Time: 14:20
 */

namespace App\Models;


class PoiPhotoList extends BaseModel
{
//    获取指定poi的id的照片列表
    public static function getPhotosByPoiId($id)
    {
        return self::where('poi_id','=',$id)->select('photo_url')->get();
    }
}
