@extends('layout.default')

@section('title','店铺列表')

@section('content')
    <form action="{{route('shopAccount')}}" class="navbar-form navbar-left" method="get">
        <input type="text" name="keywords" class="form-control">
        <input type="submit" value="搜索" class="form-control" >
    </form>
    <a href="{{route('shopAccount.create')}}" class="btn btn-primary" style="margin-top: 8px">添加商铺</a>
    <table class="table table-hover">
        <tr>
            <th>商家账号</th>
            <th>店铺名字</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($shopAccounts as $shopAccount)
        <tr>
            <td>{{$shopAccount->name}}</td>
            <td>{{$shopAccount->shopDetail['shop_name']}}</td>
            <td>{{$shopAccount->status==0?'未审核':'已审核'}}</td>
            <td><a href="{{route('shopAccount.show',['shopAccount'=>$shopAccount])}}" class="btn btn-info">查看</a></td>
        </tr>
        @endforeach
    </table>

@stop