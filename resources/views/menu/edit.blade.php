@extends('layout.default')

@section('title','修改菜单')

@section('content')
    <form method="post" action="{{route('menu.update',['menu'=>$menu])}}">
        <div class="form-group">
            <label>菜单名称</label>
            <input type="text" name="name" class="form-control" value="{{$menu->name}}">
        </div>
        <div class="form-group">
            <label>所属层级</label>
            <select name="parent_id" class="form-control">
                <option value="0" {{$menu->parent_id==0?'selected':''}}>顶级菜单</option>
                @foreach($menus as $val)
                    <option value="{{$val->id}}" {{$menu->parent_id==$val->id?'selected':''}}>{{$val->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>路由地址</label>
            <input type="text" name="my_route" class="form-control" value="{{$menu->my_route}}">
        </div>
        <div class="form-group">
            <label>排序</label>
            <input type="text" name="sort" class="form-control" value="{{$menu->sort}}">
        </div>

        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">修改</button>
    </form>

@stop

