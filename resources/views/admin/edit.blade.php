@extends('layout.default')
@section('title','添加管理员')

@section('content')
    <form  method="post" action="{{route('admin.update',['admin'=>$admin])}}">

        <div class="form-group">
            <label >用户名/手机</label>
                <input type="number" name="phone" class="form-control" placeholder="用户名/手机" value="{{ $admin->phone }}" readonly="readonly">
        </div>


        <div class="form-group">
            <label >姓名</label>
                <input type="text" name="name" class="form-control" placeholder="姓名" value="{{ $admin->name }}" readonly="readonly">

        </div>

        <div class="form-group">
            <label>拥有角色</label><br>
            @foreach($roles as $role)
                <label>
                    <input type="checkbox" name="role_id[]" value="{{$role->id}}" {{$admin->hasRole($role->name)==true?'checked':''}}>{{$role->display_name}}
                </label> &emsp;&emsp;
            @endforeach
        </div>

        <div class="form-group">
                <button type="submit" class="btn btn-default">添加</button>
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>

@stop
