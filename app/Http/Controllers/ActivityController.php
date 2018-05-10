<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use App\Model\ActivityMember;
use App\Model\ActivityPrize;
use App\Model\ShopAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $this->validate($request, [
            'title' => 'required|min:2',
            'start_time' => 'required|after:yesterday',
            'end_time' => 'required|after:start_time',
            'prize_date' => 'required|after:end_time',
            'signup_num' => 'required',
            'detail' => 'required'

        ], [
            'title.required' => '请添写标题',
            'start_time.required' => '请添写开始时间',
            'start_time.after' => '开始时间不能是之前的时间',
            'end_time.required' => '请添写结束时间',
            'end_time.after' => '结束时间不能在开始时间之前',
            'prize_date.required' => '开奖日期不能为空',
            'prize_date.after' => '开奖日期不能在报名结束日期前',
            'signup_num' => '报名人数不能为空',
            'detail.required' => '请填写内容',
        ]);
        Activity::create([
            'title' => $request->title,
            'start_time' => strtotime($request->start_time),
            'end_time' => strtotime($request->end_time),
            'prize_date' => strtotime($request->prize_date),
            'signup_num' => $request->signup_num,
            'is_prize' => 0,
            'detail' => $request->detail,
        ]);
        //成功提示
        session()->flash('success', '添加成功');
        return redirect()->route('activity.index');
    }

    //活动列表
    public function index()
    {
        $activities = Activity::all();
        return view('activity/index', compact('activities'));
    }

    //查看活动
    public function show(Activity $activity)
    {
        //已报名人数
        $count = ActivityMember::where('activity_id', $activity->id)->count();
        return view('activity/show', compact('activity', 'count'));
    }

    //活动修改
    public function edit(Activity $activity)
    {
        return view('activity/edit', compact('activity'));
    }

    //活动修改保存
    public function update(Request $request, Activity $activity)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'prize_date' => 'required|after:end_time',
            'signup_num' => 'required',
            'detail' => 'required'
        ], [
            'title.required' => '请添写标题',
            'start_time.required' => '请添写开始时间',
            'end_time.required' => '请添写结束时间',
            'end_time.after' => '结束时间不能在开始时间之前',
            'prize_date.required' => '开奖日期不能为空',
            'prize_date.after' => '开奖日期不能在报名结束日期前',
            'signup_num' => '报名人数不能为空',
            'detail.required' => '请填写内容',
        ]);
        //保存
//        dd($request->input());
        $activity
            ->update([
                'title' => $request->title,
                'start_time' => strtotime($request->start_time),
                'end_time' => strtotime($request->end_time),
                'prize_date' => strtotime($request->prize_date),
                'signup_num' => $request->signup_num,
                'detail' => $request->detail
            ]);
        //提示
        session()->flash('success', '修改成功');
        return redirect()->route('activity.index');
    }

    //活动删除
    public function destroy(Activity $activity)
    {
        if (time() < $activity->end_time && time() > $activity->start_time) {
            session()->flash('danger', '活动期间,不能删除');
            return redirect()->route('activity.index');
        } else {
            $activity->delete();
            session()->flash('success', '删除成功');
            return redirect()->route('activity.index');
        }

    }

    //活动开奖
    public function lottery(Request $request)
    {
        //报名人数
        $count = ActivityMember::where('activity_id', $request->activity_id)->count();
        //判断报名人数等于0时不能开奖
        if ($count==0){
            session()->flash('success','报名人数为0,不能开奖');
            return back();
        }
        //报名人的id
        $shopAccount_ids = ActivityMember::where('activity_id', $request->activity_id)->pluck('shopAccount_id')->shuffle();
        //奖品的id
        $prize_ids = ActivityPrize::where('activity_id', $request->activity_id)->pluck('id')->shuffle();
        //配对
        $result = [];
        foreach ($shopAccount_ids as $shopAccount_id) {
            $prize_id = $prize_ids->pop();
            if ($prize_id == null)
                break;
            $result[$prize_id] = $shopAccount_id;
        }
        DB::transaction(function () use ($result, $request) {
            foreach ($result as $pid => $sid) {
                DB::table('activity_prizes')
                    ->where('id', $pid)
                    ->update(['shopAccount_id' => $sid]);
            }
            //修改活动开奖状态
            DB::table('activities')
                ->where('id', $request->activity_id)
                ->update(['is_prize' => 1]);
        });
        session()->flash('success', '开奖成功');
        return redirect()->route('activity.index');
    }

    //活动中奖名单
    public function winning(Request $request)
    {

        //获取活动对应的中奖名单
        $winning = ActivityPrize::where([
            ['activity_id', $request->activity_id],
            ['shopAccount_id','<>','']
        ])->get();
//        dd($winning);
        foreach ($winning as $value) {
            $value->shopAccount_name=ShopAccount::where('id',$value->shopAccount_id)->first()->name;

        }

        return view('activity/wining',compact('winning'));
    }

}
