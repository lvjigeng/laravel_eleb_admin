@extends('layout.default')

@section('title','修改奖品')

@section('content')
    <form method="post" action="{{route('activityPrize.update',['activityPrize'=>$activityPrize])}}">

        <div class="form-group">
            <label>奖品名称</label>
            <input type="text" name="name" class="form-control" value="{{$activityPrize->name}}">
        </div>

        <div class="form-group">
            <label for="exampleInputFile">奖品描述</label>
            <textarea name="description" cols="30" rows="7" class="form-control">{{$activityPrize->description}}</textarea>
        </div>

        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">添加</button>
    </form>

@stop

