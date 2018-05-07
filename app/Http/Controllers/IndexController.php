<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function __construct()
    {
        //没有登录只能看
        $this->middleware('auth', [
            'except' => ['welcome']
        ]);
        //登录了不能看,游客能看
        $this->middleware('guest', [
            'only' => ['welcome']
        ]);


    }
    public function index()
    {
        return view('index/index');
    }
    //欢迎界面
    public function welcome()
    {

        return view('index/welcome');
    }
}
