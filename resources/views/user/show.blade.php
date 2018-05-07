@extends('layout.default')
    @section('title','会员详细信息')

    @section('content')
        <p><h2>姓名:{{$user->name}}</h2></p>
        <p>账号:{{$user->tel}}</p>
        <p>状态:{{$user->status==0?'禁用':'激活'}}</p>
        <p>
            @if($user->status==0)
                <a href="{{route('user.activating',['user'=>$user])}}" class="btn btn-info">账号激活</a>
            @else
                <a href="{{route('user.disable',['user'=>$user])}}" class="btn btn-danger" id="mydisable">账号禁用</a>
            @endif
        </p>



    @stop