@extends('layout.default')

@section('title','店铺列表')

@section('content')
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
            <td><a href="{{route('show',['shopAccount'=>$shopAccount])}}" class="btn btn-info">查看</a></td>
        </tr>
        @endforeach
    </table>

@stop