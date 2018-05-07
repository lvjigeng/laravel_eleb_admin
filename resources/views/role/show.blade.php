@extends('layout.default')

    @section('title','角色详情')

    @section('content')
        <p><h2>显示名称:{{$role->display_name}}</h2></p>
        <p><strong>角色名称:</strong>&emsp;{{$role->name}}</p>
        <p><strong>角色描述:</strong>&emsp;{{$role->description}}</p>
        <p><strong>拥有权限:&emsp;</strong></p>
        @foreach($permissions as $val)
        @if($role->hasPermission($val->name)==true)
            <span>{{$val->display_name}} &emsp;&emsp;&emsp;</span>
        @endif
        @endforeach
    @stop