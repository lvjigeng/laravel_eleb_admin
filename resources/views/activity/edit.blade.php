@extends('layout.default')

@section('title','修改活动')

@section('content')
    <form class="form-group" method="post" action="{{route('activity.update',['activity'=>$activity])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputName2">活动标题</label>
            <input type="text" name="title" class="form-control" id="exampleInputName2" placeholder="分类名称" value="{{$activity->title}}">
        </div>
        <div class="form-group">
            <label for="start_time">开始时间</label>
            <input type="date" id="start_time" name="start_time" class="form-control"  value="{{date('Y-m-d',$activity->start_time)}}">
        </div>

        <div class="form-group">
            <label for="end_time">结束时间</label>
            <input type="date" id="end_time" name="end_time" class="form-control"  value="{{date('Y-m-d',$activity->end_time)}}">
        </div>


    <script id="container" name="detail" type="text/plain">
        {{strip_tags($activity->detail)}}
    </script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>

    {{csrf_field()}}
    {{method_field('PUT')}}
    <button type="submit" class="btn btn-default">修改</button>
    </form>

@stop