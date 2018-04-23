<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UploadController extends Controller
{
    //
    public function upload(Request $request)
    {
        $imgPath=$request->file('file')->store($request->dir);
        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile('eleb', $imgPath, storage_path('app/'.$imgPath));
        } catch(OssException $e) {
            echo '上传失败';
            printf($e->getMessage().'\n');
        }
        $imgPath='https://eleb.oss-cn-beijing.aliyuncs.com/'.$imgPath;
        return ['url'=>$imgPath];
    }
}
