<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use App\Model\ActivityPrize;
use Illuminate\Http\Request;

class ActivityPrizeController extends Controller
{
    //添加奖品
    public function create(Request $request)
    {
        $activity_id=$request->activity_id;

        $activities=Activity::get();
        return view('activityPrize/create',compact('activities','activity_id'));
    }
    //添加保存
    public function store(Request $request)
    {
//        dd($request->input());
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required'
        ],[
            'name.required'=>'奖品名称不能为空',
            'description.required'=>'奖品描述不能为空',
        ]);

        ActivityPrize::create([
            'name'=>$request->name,
            'activity_id'=>$request->activity_id,
            'description'=>$request->description
        ]);

        session()->flash('success','添加讲评成功');
        return redirect()->route('activity.index');

    }
    //奖品列表
    public function index(Request $request)
    {
        $queries=$request->query();
        $activityPrizes=ActivityPrize::where('activity_id',$request->activity_id)->paginate(10);
        return view('activityPrize/index',compact('activityPrizes','queries'));
    }
    //修改页面
    public function edit(ActivityPrize $activityPrize)
    {
        if (time()>$activityPrize->prize_date){
            session()->flash('活动开奖时间已到,不能再修改奖品');
            return redirect()->route('activity.index');
        }
        $activities=Activity::get();
        return view('activityPrize/edit',compact('activityPrize','activities'));

    }
    //修改保存
    public function update(Request $request,ActivityPrize $activityPrize)
    {
        $this->validate($request,[

            'name'=>'required',
            'description'=>'required'
        ],[

            'name.required'=>'奖品名称不能为空',
            'description.required'=>'奖品描述不能为空',
        ]);
        $activityPrize->update([

            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('activity.index');
    }
    //删除
    public function destroy(ActivityPrize $activityPrize)
    {
        $activityPrize->delete();
        echo 'success';
    }
}
