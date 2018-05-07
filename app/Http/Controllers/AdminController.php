<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $roles=Role::get();
        return view('admin/create',compact('roles'));
    }
    //添加保存
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'required|confirmed|min:6',
            'phone'=>'required|regex:/^1[34578][0-9]{9}$/|unique:admins',
            'role_id'=>'required'
        ],[
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名不能小于2位',
            'password.min'=>'密码不能小于6位',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'两次密码不一致',
            'phone.required'=>'手机不能为空',
            'phone.regex'=>'手机格式不正确',
        ]);
        $admin=Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'phone'=>$request->phone,
        ]);
        $admin->attachRoles($request->role_id);
        //提示成功
        session()->flash('success','添加用户成功');
        return redirect()->route('admin.index');
    }
    //管理员列表
    public function index(){
        $admins=Admin::all();
        return view('admin/index',compact('admins'));
    }

    public function show(Admin $admin)
    {
        $roles=Role::get();
        return view('admin/show',compact('admin','roles'));
    }
    //修改管理员表单
    public function edit(Admin $admin)
    {
        $roles=Role::get();
        return view('admin/edit',compact('admin','roles'));
    }
    //保存修改
    public function update(Request $request,Admin $admin)
    {

        $this->validate($request,[
            'name'=>'required|min:2',
            'phone'=>[
                'required',
                'regex:/^1[34578][0-9]{9}$/',
                Rule::unique('admins')->ignore($admin->id)
            ],
            'role_id'=>'required'
        ],[
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名不能小于2位',
            'phone.required'=>'手机不能为空',
            'phone.regex'=>'手机格式不正确',
        ]);
        $admin->update([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'phone'=>$request->phone,
        ]);
        $admin->syncRoles($request->role_id);
        session()->flash('success','修改成功');
        return redirect()->route('admin.index');
    }
    //删除管理员
    public function destroy(Admin $admin)
    {
        $admin->delete();
        echo 'success';
    }

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
