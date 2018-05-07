<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    //权限列表
    public function index(Request $request)
    {
        $queries=$request->query();
        $permissions=Permission::orderBy('name')->paginate(10);
        return view('permission/index',compact('permissions','queries'));
    }
    //添加权限
    public function create()
    {
        return view('permission/create');
    }
    //保存添加权限
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:permissions',
            'display_name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'权限名称不能为空',
            'name.unique'=>'权限名称已存在',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
        ]);
        $permission=new Permission();
        $permission->name=$request->name;
        $permission->display_name=$request->display_name;
        $permission->description=$request->description;
        $permission->save();
        session()->flash('添加权限修改');
        return redirect()->route('permission.index');
    }
    //修改权限表单
    public function edit(Permission $permission)
    {
        return view('permission/edit',compact('permission'));
    }
    //保存修改权限
    public function update(Request $request,Permission $permission)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('permissions')->ignore($permission->id)
            ],
            'display_name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'权限名称不能为空',
            'name.unique'=>'权限名称已存在',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
        ]);
        $permission->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
            ]);
        session()->flash('success','修改成功');
        return redirect()->route('permission.index');
    }
    //删除权限
    public function destroy(Permission $permission)
    {
        $permission->delete();
        echo 'success';
    }
}
