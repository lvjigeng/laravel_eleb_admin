<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //没登录什么权限都没有
    public function __construct()
    {
       $this->middleware('auth',[

       ]);
    }
    //添加表单
    public function create()
    {
        return view('admin/create');
    }
    //添加保存
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'required|confirmed|min:6',
            'phone'=>'required|regex:/^1[34578][0-9]{9}$/'
        ],[
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名不能小于2位',
            'password.min'=>'密码不能小于6位',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次密码不一致',
            'phone.required'=>'手机不能为空',
            'phone.regex'=>'手机格式不正确',
        ]);
        Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'phone'=>$request->phone,
        ]);
        //提示成功
        session()->flash('success','添加用户成功');
        return redirect()->route('admin.index');
    }
    //列表
    public function index(){
        $admins=Admin::all();
        return view('admin/index',compact('admins'));
    }
    //修改个人信息
    //修改密码
    public function editPwd(Request $request,Admin $admin)
    {
        //验证
        if ($_POST) {
            $this->validate($request, [
                'password' => 'required',
                'new_password' => 'required|confirmed|min:6',
            ], [
                'password.required' => '请输入原密码',
                'new_password.required' => '请原输入新密码',
                'new_password.confirmed' => '两次密码不一致',
                'new_password.min' => '密码最小位6位',
            ]);
            //验证原密码
            //原密码
//            $password = $request->password;
//            //新密码
//            $new_password = $request->new_password;
//            //id
//            $id = $admin->id;
//            //数据库的东西
//            $res=DB::table('admins')->where('id',$id)->select('password')->first();

            if (Hash::check($request->password,Auth::user()->password)) {
                $admin
                    ->where('id',$admin->id)
                    ->update(['password' =>bcrypt($request->new_password)]);
                //修改成功提示
                session()->flash('success', '修改密码成功,请重新登录');
                Auth::logout();
                return redirect()->route('login');
            } else {
                //原密码不正确
                session()->flash('danger', '原密码不正确');
                return back()->withInput();
            }
        }
        else{
            //显示页面
            return view('admin.editPwd', compact('admin'));
        }
    }
}
