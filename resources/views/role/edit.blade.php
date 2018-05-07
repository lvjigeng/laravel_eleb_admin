@extends('layout.default')

@section('title','修改角色')

@section('content')
    <form method="post" action="{{route('role.update',['role'=>$role])}}">
        <div class="form-group">
            <label>角色名称</label>
            <input type="text" name="name" class="form-control" value="{{$role->name}}">
        </div>
        <div class="form-group">
            <label>显示名称</label>
            <input type="text" name="display_name" class="form-control" value="{{$role->display_name}}">
        </div>
        <div class="form-group">
            <label>角色描述</label>
            <textarea name="description" id="" cols="30" rows="7" class="form-control">{{$role->description}}</textarea>
        </div>
        <div class="form-group">
            <label>拥有权限</label>
            @foreach($permissions as $permission)
                <input type="checkbox" name="permission_id[]" value="{{$permission->id}}" {{$role->hasPermission($permission->name)==true?'checked':''}}>{{$permission->display_name}} &emsp;&emsp;
            @endforeach
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">修改</button>
    </form>

@stop

