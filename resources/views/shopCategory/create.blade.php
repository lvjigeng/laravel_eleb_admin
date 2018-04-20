@extends('layout.default')
@section('title','添加店铺分类')

@section('content')
    <form class="form-inline" method="post" action="{{route('shopCategory.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputName2">分类名称</label>
            <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="分类名称" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputName2">图片</label>
            <input type="file" name="img" class="form-control"  value="{{old('img')}}">
        </div>

        <button type="submit" class="btn btn-default">添加</button>

        {{csrf_field()}}
    </form>

@stop
