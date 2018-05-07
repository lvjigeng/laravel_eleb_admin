@extends('layout.default')

@section('title','添加权限')

@section('content')
    <form method="post" action="{{route('permission.store')}}">
        <div class="form-group">
            <label>权限名称</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>显示名称</label>
            <input type="text" name="display_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">权限描述</label>
            <textarea name="description" id="" cols="30" rows="7" class="form-control"></textarea>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">添加</button>
    </form>

@stop

