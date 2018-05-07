@extends('layout.default')

@section('title','添加角色')

@section('content')
    <form method="post" action="{{route('role.store')}}">
        <div class="form-group">
            <label>角色名称</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>显示名称</label>
            <input type="text" name="display_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">角色描述</label>
            <textarea name="description" id="" cols="30" rows="7" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">拥有权限</label><br>
            @foreach($permissions as $permission)
            <label><input type="checkbox" name="permission_id[]" value="{{$permission->id}}">{{$permission->display_name}}</label> &emsp;&emsp;
        @endforeach
        </div>
        {{csrf_field()}}

        <button type="submit" class="btn btn-default">添加</button>
    </form>

@stop

