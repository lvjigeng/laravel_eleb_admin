@extends('layout.default')
@section('title','修改店铺分类')

@section('content')
    <form class="form-inline" method="post" action="{{route('shopCategory.update',['shopCategory'=>$shopCategory])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputName2">分类名称</label>
            <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="分类名称" value="{{$shopCategory->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputName2">原图片</label>
            <img src="{{\Illuminate\Support\Facades\Storage::url($shopCategory->img)}}" alt="" class="img-thumbnail" width="70px">


        <div class="form-group">
            <label for="exampleInputName2">新图片</label>
            <input type="file" name="img" class="form-control">
        </div>

        <button type="submit" class="btn btn-default">修改</button>

        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>

@stop
