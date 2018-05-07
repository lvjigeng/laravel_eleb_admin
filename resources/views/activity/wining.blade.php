@extends('layout.default')
@section('title','中奖名单')


@section('content')

    <table class="table table-hover">
        <tr>
            <th>店铺账号</th>
            <th>奖品</th>

        </tr>
        @foreach($winning as $value)
            <tr >
                <td>{{$value->shopAccount_name}}</td>
                <td>{{$value->name}}</td>
            </tr>
        @endforeach
    </table>

@stop
