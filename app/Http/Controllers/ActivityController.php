<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'except'=>[]
//        ]);
//    }

    //添加
    public function create()
    {
        return view('activity/create');
    }
    //添加保存
    public function store(Request $request)
    {
       $this->validate($request,[
           'title'=>'required|min:2',
           'start_time'=>'required|after:yesterday',
           'end_time'=>'required|after:start_time',
           'detail'=>'required'
       ],[
            'title.required'=>'请添写标题',
           'start_time.required'=>'请添写开始时间',
           'start_time.after'=>'开始时间不能是之前的时间',
           'end_time.required'=>'请添写结束时间',
           'end_time.after'=>'结束时间不能在开始时间之前',
           'detail.required'=>'请填写内容',
       ]);
       Activity::create([
           'title'=>$request->title,
           'start_time'=>strtotime($request->start_time),
           'end_time'=>strtotime($request->end_time),
           'detail'=>$request->detail,
       ]);
        //成功提示
        session()->flash('success','添加成功');
        return redirect()->route('activity.index');
    }
    //活动列表
    public function index()
    {
        $activities=Activity::all();
        return view('activity/index',compact('activities'));
    }
    //查看列表
    public function show(Activity $activity)
    {
        return view('activity/show',compact('activity'));
    }
    //活动修改
    public function edit(Activity $activity)
    {
        return view('activity/edit',compact('activity'));
    }
    //活动修改保存
    public function update(Request $request,Activity $activity)
    {
        $this->validate($request,[
            'title'=>'required|min:2',
            'start_time'=>'required',
            'end_time'=>'required|after:start_time',
            'detail'=>'required'
        ],[
            'title.required'=>'请添写标题',
            'start_time.required'=>'请添写开始时间',
            'end_time.required'=>'请添写结束时间',
            'end_time.after'=>'结束时间不能在开始时间之前',
            'detail.required'=>'请填写内容',
        ]);
        //保存
        $activity->where('id',$request->id)
                 ->update([
                     'title'=>$request->title,
                     'start_time'=>strtotime($request->start_time),
                     'end_time'=>strtotime($request->end_time),
                     'detail'=>$request->detail
                 ]);
        //提示
        session()->flash('success','修改成功');
        return redirect()->route('activity.index');
    }
    //活动删除
    public function destroy(Activity $activity)
    {
        if (time()<$activity->end_time &&time()>$activity->start_time){
            session()->flash('danger','活动期间,不能删除');
            return redirect()->route('activity.index');
        }else{
            $activity->delete();
            session()->flash('success','删除成功');
            return redirect()->route('activity.index');
        }

    }

}
