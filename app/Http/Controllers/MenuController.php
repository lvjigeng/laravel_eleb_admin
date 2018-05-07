<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    //添加表单
    public function create()
    {
        $menus=Menu::where('parent_id',0)->get();
        return view('menu/create',compact('menus'));
    }
    //添加保存
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'my_route'=>'required'
        ],[
            'name.required'=>'菜单名不能为空',
            'my_route.required'=>'路由不能为空',
        ]);
        Menu::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'my_route'=>$request->my_route,
            'sort'=>$request->sort
        ]);
        session()->flash('success','添加分类成功');
        return redirect()->route('menu.index');
    }
    //菜单列表
    public function index()
    {
        $menus=Menu::orderBy('parent_id')->get();
        //找到父级菜单的名字
        foreach ($menus as $menu){
            if ($menu->parent_id!=0){
                $menu->parent_name=Menu::find($menu->parent_id)->name;
            }else{
                $menu->parent_name='顶级菜单';
            }
        }
        return view('menu/index',compact('menus'));
    }
    //修改表单
    public function edit(Menu $menu)
    {
        $menus=Menu::where('parent_id',0)->get();
        //echo '<pre>';
        //var_dump($menu);exit;
        return view('menu/edit',compact('menu','menus'));
    }

    public function update(Request $request,Menu $menu)
    {
        $this->validate($request,[
            'name'=>'required',
            'my_route'=>'required',

        ],[
            'name.required'=>'菜单名不能为空',
            'my_route.required'=>'路由地址不能为空'
        ]);
        $menu->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'my_route'=>$request->my_route,
            'sort'=>$request->sort
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('menu.index');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        echo 'success';
    }
}
