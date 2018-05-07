<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    //角色列表
    public function index(Request $request)
    {
        $queries=$request->query();
        $roles=Role::paginate(10);
        return view('role/index',compact('roles','queries'));
    }
    //查看角色
    public function show(Role $role)
    {
        $permissions=Permission::get();
        return view('role/show',compact('role','permissions'));
    }
    //添加角色
    public function create()
    {
        $permissions=Permission::orderBy('name')->get();
        return view('role/create',compact('permissions'));
    }
    //保存添加角色
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:permissions',
            'display_name'=>'required',
            'description'=>'required',
            'permission_id'=>'required'
        ],[
            'name.required'=>'角色名称不能为空',
            'name.unique'=>'角色名称已存在',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
            'permission_id.required'=>'权限不能为空'
        ]);
        $role=new Role();
        $role->name=$request->name;
        $role->display_name=$request->display_name;
        $role->description=$request->description;
        $role->save();
        $role->attachPermissions($request->permission_id);
        session()->flash('添加角色成功');
        return redirect()->route('role.index');
    }
//    //修改角色表单
    public function edit(Role $role)
    {
        $permissions=Permission::orderBy('name')->get();
        return view('role/edit',compact('role','permissions'));
    }
    //保存修改角色
    public function update(Request $request,Role $role)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('roles')->ignore($role->id)
            ],
            'display_name'=>'required',
            'description'=>'required',
            'permission_id'=>'required'
        ],[
            'name.required'=>'角色名称不能为空',
            'name.unique'=>'角色名称已存在',
            'display_name.required'=>'显示名称不能为空',
            'description.required'=>'描述不能为空',
            'permission_id.required'=>'权限不能为空'
        ]);
        $role->name=$request->name;
        $role->display_name=$request->display_name;
        $role->description=$request->description;
        $role->save();
        $role->syncPermissions($request->permission_id);
        session()->flash('success','修改成功');
        return redirect()->route('role.index');
    }
    //删除角色
    public function destroy(Role $role)
    {

        $role->delete();
        echo 'success';
    }
}
