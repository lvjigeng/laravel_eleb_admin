@extends('layout.default')
@section('title','活动列表')

@section('content')
    <a href="{{route('activity.create')}}" class="btn btn-default">添加</a>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>是否开奖</th>
            <th>操作</th>
        </tr>
        @foreach($activities as $activity)
            <tr data-id="{{$activity->id}}">
                <td>{{ $activity->id}}</td>
                <td>{{$activity->title}}</td>
                <td>{{date('Y-m-d H:i:s',$activity->start_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$activity->end_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$activity->prize_date)}}</td>
                <td>{{$activity->is_prize==0?'否':'是'}}</td>
                <form action="{{route('activity.destroy',['activity'=>$activity])}}" method="post">
                <td>
                    <a href="{{route('activityPrize.create',['activity_id'=>$activity->id])}}" class="btn btn-primary">添加奖品</a>&emsp;
                    <a href="{{route('activityPrize.index',['activity_id'=>$activity->id])}}" class="btn btn-info">奖品列表</a>&emsp;
                    <a href="{{route('activity.show',['activity'=>$activity])}}" class="btn btn-info">查看</a>&emsp;
                    <a href="{{route('activity.edit',['activity'=>$activity])}}" class="btn btn-warning">编辑</a>
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                   <button class="btn btn-danger">删除</button>

                </td>
                </form>

            </tr>
        @endforeach
    </table>

@stop

{{--@section('js')--}}
    {{--<script>--}}
        {{--$(".btn-danger").click(function () {--}}
            {{--if (confirm('确认删除,删除后将无法恢复')){--}}
                {{--var tr=$(this).closest('tr');--}}
                {{--var id=tr.data('id')--}}
                {{--$.ajax({--}}
                    {{--type:"DELETE",--}}
                    {{--url:'activity/'+id,--}}
                    {{--data:'_token={{csrf_token()}}',--}}
                    {{--success:function (msg) {--}}
                        {{--tr.fadeOut();--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}
        {{--})--}}
    {{--</script>--}}

{{--@stop--}}