@extends('layout.default')

@section('title','会员列表')

@section('content')

    <table class="table table-hover">
        <tr>
            <th>会员账号</th>
            <th>会员名字</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->tel}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->status==0?'禁用':'激活'}}</td>
            <td>
                <a href="{{route('user.show',['user'=>$user])}}" class="btn btn-info">查看信息</a>
                {{--@if($user->status==0)--}}
                    {{--<a href="{{route('user.activating',['user'=>$user])}}" class="btn btn-info">账号激活</a>--}}
                {{--@else--}}
                    {{--<a href="{{route('user.disable',['user'=>$user])}}" class="btn btn-danger" id="mydisable">账号禁用</a>--}}
                {{--@endif--}}
            </td>
        </tr>
        @endforeach
    </table>

@stop
@section('js')
    <script type="text/javascript">
        $('#mydisable').click(function () {
            alert('确认禁用该账号?')
        })
    </script>

@stop