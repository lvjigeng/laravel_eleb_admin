<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>"login"
            ]);
    }
    //登录页面
    public function login()
    {
      return view('login/login');
    }
    //登录检查
    public function check(Request $request)
    {
        $this->validate($request,[
            'phone'=>'required',
            'password'=>'required',
        ],[
            'phone.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        ]);
        //验证
        if (Auth::attempt(['phone'=>$request->phone,'password'=>$request->password],$request->has('rememberMe'))){
            session()->flash('success','登录成功');
            return redirect()->route('shopAccount');
        }else{

            session()->flash('danger','密码或用户名错误');
            return back()->withInput();
        }
    }
    //退出
    public function logout()
    {
        Auth::logout();
        session()->flash('success','退出成功');
        return redirect()->route('login');
    }


}
