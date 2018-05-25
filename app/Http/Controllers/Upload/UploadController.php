<?php
/**
 * Created by PhpStorm.
 * User: nitia
 * Date: 2018/5/25 0025
 * Time: 11:33
 */

namespace App\Http\Controllers\Upload;


use App\Http\Controllers\Api\ApiController;

class UploadController extends ApiController
{
    const UPLOAD_OK = 0;
    const UPLOAD_NO_FILE = 1;
    const UPLOAD_FAILED = 2;

}
