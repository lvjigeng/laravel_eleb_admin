@extends('layout.default')
    @section('title',$activity->title)

    @section('content')
        <h2>{{$activity->title}}</h2>
            <small>开始时间:{{date('Y-m-d H:i:s',$activity->start_time)}} &emsp;&emsp;结束时间:{{date('Y-m-d H:i:s',$activity->start_time)}}</small>
        <hr>
        {!! $activity->detail !!}

    @stop