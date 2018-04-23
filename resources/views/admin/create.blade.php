@extends('layout.default')
@section('title','添加管理员')

@section('content')
    <form class="form-horizontal" method="post" action="{{route('admin.store')}}" enctype="multipart/form-data">

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">用户名/手机</label>
            <div class="col-sm-11">
                <input type="number" name="phone" class="form-control" id="inputEmail3" placeholder="用户名/手机" value="{{ old('phone') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">密码</label>
            <div class="col-sm-11">
                <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="密码" value="{{ old('password') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">密码</label>
            <div class="col-sm-11">
                <input type="password" name="password_confirmation" class="form-control" id="inputEmail3" placeholder="确认密码" value="{{ old('password_confirmation') }}">
            </div>
        </div>



        <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">姓名</label>
            <div class="col-sm-11">
                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="姓名" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-11">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
        {{csrf_field()}}
    </form>

@stop
