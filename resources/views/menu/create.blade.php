@extends('layout.default')

@section('title','添加菜单')

@section('content')
    <form method="post" action="{{route('menu.store')}}">
        <div class="form-group">
            <label>菜单名称</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>所属层级</label>
            <select name="parent_id" class="form-control">
                <option value="0">顶级菜单</option>
                @foreach($menus as $menu)
                    <option value="{{$menu->id}}">{{$menu->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>路由地址</label>
            <input type="text" name="my_route" class="form-control" value="#">
        </div>
        <div class="form-group">
            <label>排序</label>
            <input type="text" name="sort" class="form-control">
        </div>

        {{csrf_field()}}
        <button type="submit" class="btn btn-default">添加</button>
    </form>

@stop

