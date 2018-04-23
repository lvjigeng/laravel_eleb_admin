@extends('layout.default')
@section('title','管理员列表')


@section('content')
    <a href="{{route('admin.create')}}" class="btn btn-default">添加</a>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>用户名/电话</th>
            <th>姓名</th>
            {{--<th>操作</th>--}}
        </tr>
        @foreach($admins as $admin)
        <tr data-id="{{$admin->id}}">
            <td>{{ $admin->id}}</td>
            <td>{{$admin->phone}}</td>
            <td>{{$admin->name}}</td>
            {{--<td>--}}
                {{--<a href="{{route('member.show',['member'=>$member])}}" class="btn btn-default">查看</a>--}}
                {{--&emsp;<a href="{{route('member.edit',['member'=>$member])}}" class="btn btn-warning">编辑</a>--}}
                {{--&emsp;<a href="" class="btn btn-danger">删除</a>--}}
            {{--</td>--}}
        </tr>
        @endforeach
    </table>
    {{--{{$members->appends($queries)->links()}}--}}
@stop

{{--@section('js')--}}
    {{--<script>--}}

        {{--$(".btn-danger").click(function () {--}}
            {{--if (confirm('确认删除该数据,删除后无法恢复')){--}}
                {{--var tr=$(this).closest('tr');--}}
                {{--var id=tr.data('id')--}}
                {{--$.ajax({--}}
                    {{--type:"DELETE",--}}
                    {{--url:'admin/'+id,--}}
                    {{--data:'_token={{csrf_token()}}',--}}
                    {{--success:function (msg) {--}}
                        {{--tr.remove();--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        {{--});--}}
    {{--</script>--}}
    {{--@stop--}}