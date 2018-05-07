<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //会与账号列表
    public function index()
    {
        $users=User::get();
        return view('user/index',compact('users'));
    }
    //会员详细信息
    public function show(User $user)
    {
        return view('user/show',compact('user'));
    }
    //账号禁用
    public function disable(User $user)
    {
        User::where('id',$user->id)->update(['status'=>0]);
        session()->flash('success','禁用账号成功');
        return redirect()->route('user.index');
    }
    //账号激活
    public function activating(User $user)
    {
        User::where('id',$user->id)->update(['status'=>1]);
        session()->flash('success','激活账号成功');
        return redirect()->route('user.index');
    }
}
