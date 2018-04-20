<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\ShopCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //添加分类页面
    public function create()
    {
        return view('shopCategory/create');
    }
    //添加分类保存
    public function store(Request $request)
    {
        //验证
        $this->validate($request,[
            'name'=>'required|max:10',
            'img'=>'required',
        ],[
            'name.required'=>'分类名字不能为空,请添写分类名字',
            'img.required'=>'图片不能为空,请上传图片',
        ]);
        $imgPath=$request->file('img')->store('public/shopCategory');
        //保存
        ShopCategory::create([
            'name'=>$request->name,
            'img'=>$imgPath
        ]);
        //提示
        session()->flash('success','添加分类成功');
        //跳转
        return redirect()->route('shopCategory.index');

    }
    //分类列表
    public function index()
    {
        $shopCategories=ShopCategory::all();
        return view('shopCategory/index',compact('shopCategories'));

    }
    //修改页面
    public function edit(ShopCategory $shopCategory)
    {
        return view('shopCategory/edit',compact('shopCategory'));
    }
    //修改保存
    public function update(Request $request,ShopCategory $shopCategory)
    {
        //验证
        $this->validate($request,[
            'name'=>'required|max:10',

        ],[
            'name.required'=>'分类名字不能为空,请添写分类名字',

        ]);
        //判断是否上传,上传了就赋给 $shopCategory->img
        if ($request->img){
            $shopCategory->img=$request->file('img')->store('public/shopCategory');
        }
        //没上传就直接保存
        $shopCategory->update([
           'name'=>$request->name,
           'img'=>$shopCategory->img
        ]);
        //提示
        session()->flash('success','修改分类成功');
        //跳转
        return redirect()->route('shopCategory.index');

    }
}
