@extends('layout.default')

@section('title','添加活动')

@section('content')
    <form class="form-group" method="post" action="{{route('activity.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputName2">活动标题</label>
            <input type="text" name="title" class="form-control" id="exampleInputName2" placeholder="分类名称" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="start_time">报名开始时间</label>
            <input type="date" id="start_time" name="start_time" class="form-control"  value="{{old('start_time')}}">
        </div>

        <div class="form-group">
            <label for="end_time">报名结束时间</label>
            <input type="date" id="end_time" name="end_time" class="form-control"  value="{{old('end_time')}}">
        </div>

        <div class="form-group">
            <label for="prize_date">开奖时间</label>
            <input type="date" id="prize_date" name="prize_date" class="form-control"  value="{{old('prize_date')}}">
        </div>

        <div class="form-group">
            <label for="signup_num">报名人数</label>
            <input type="number" id="signup_num" name="signup_num" class="form-control"  value="{{old('signup_num')}}">
        </div>


    {{--富文本编辑器--}}
    <script id="container" name="detail" type="text/plain">
        {!! old('detail') !!}
    </script>

        {{csrf_field()}}

        <button type="submit" class="btn btn-default">添加</button>
    </form>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>



@stop