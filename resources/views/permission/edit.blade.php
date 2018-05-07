@extends('layout.default')

@section('title','修改权限')

@section('content')
    <form method="post" action="{{route('permission.update',['permission'=>$permission])}}">
        <div class="form-group">
            <label>权限名称</label>
            <input type="text" name="name" class="form-control" value="{{$permission->name}}">
        </div>
        <div class="form-group">
            <label>显示名称</label>
            <input type="text" name="display_name" class="form-control" value="{{$permission->display_name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">权限描述</label>
            <textarea name="description" id="" cols="30" rows="7" class="form-control">{{$permission->description}}</textarea>
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">修改</button>
    </form>

@stop

