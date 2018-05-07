@extends('layout.default')
@section('title','添加管理员')

@section('content')
    <form  method="post" action="{{route('admin.store')}}" enctype="multipart/form-data">

        <div class="form-group">
            <label >用户名/手机</label>
                <input type="number" name="phone" class="form-control" id="inputEmail3" placeholder="用户名/手机" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label >密码</label>

                <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="密码" value="{{ old('password') }}">
        </div>

        <div class="form-group">
            <label>密码</label>

                <input type="password" name="password_confirmation" class="form-control" id="inputEmail3" placeholder="确认密码" value="{{ old('password_confirmation') }}">

        </div>



        <div class="form-group">
            <label >姓名</label>
                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="姓名" value="{{ old('name') }}">

        </div>

        <div class="form-group">
            <label>拥有角色</label><br>
            @foreach($roles as $role)
                <label><input type="checkbox" name="role_id[]" value="{{$role->id}}">{{$role->display_name}}</label> &emsp;&emsp;
            @endforeach
        </div>

        <div class="form-group">
                <button type="submit" class="btn btn-default">添加</button>
        </div>
        {{csrf_field()}}
    </form>

@stop
