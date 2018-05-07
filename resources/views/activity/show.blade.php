@extends('layout.default')
    @section('title',$activity->title)

    @section('content')
        <h2>{{$activity->title}}</h2>
        @if($activity->is_prize==0)
        <p><a href="{{route('activity.lottery',['activity_id'=>$activity->id])}}" class="btn btn-danger">开奖</a></p>
        @else
            <p><a href="{{route('activity.winning',['activity_id'=>$activity->id])}}" class="btn btn-danger">中奖名单</a></p>

        @endif
            <p><small>报名开始时间:{{date('Y-m-d H:i:s',$activity->start_time)}} &emsp;&emsp;报名结束时间:{{date('Y-m-d H:i:s',$activity->start_time)}}&emsp;&emsp;开奖时间:{{date('Y-m-d H:i:s',$activity->prize)}}</small></p>
        <p><small>活动人数限制:{{$activity->signup_num}}人</small></p>
        <p><small>已报名人数:{{$count}}人</small></p>
        <hr>
        {!! $activity->detail !!}

    @stop