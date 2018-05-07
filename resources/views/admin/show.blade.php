@extends('layout.default')

    @section('title','角色详情')

    @section('content')
        <p><h2>管理员姓名:{{$admin->name}}</h2></p>
        <p><strong>管理员账号:</strong>&emsp;{{$admin->phone}}</p>

        <p><strong>拥有角色:&emsp;</strong>
        @foreach($roles as $val)
        @if($admin->hasRole($val->name)==true)
            <span>{{$val->display_name}} &emsp;&emsp;&emsp;</span>
        @endif
        @endforeach
        </p>
    @stop