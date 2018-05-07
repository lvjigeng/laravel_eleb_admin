@extends('layout.default')

@section('title','添加奖品')

@section('content')
    <form method="post" action="{{route('activityPrize.store')}}">
        <div class="form-group">
            <input type="hidden" name="activity_id" value="{{$activity_id}}">
        </div>

        <div class="form-group">
            <label>奖品名称</label>
            <input type="text" name="name" class="form-control">
        </div>


        <div class="form-group">
            <label for="exampleInputFile">奖品描述</label>
            <textarea name="description" id="" cols="30" rows="7" class="form-control"></textarea>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">添加</button>
    </form>

@stop

