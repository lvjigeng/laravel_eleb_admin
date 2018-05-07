@extends('layout.default')
@section('title','菜单列表')


@section('content')
    <a href="{{route('menu.create')}}" class="btn btn-default">添加</a>
    <table class="table table-hover">
        <tr>
            <th>菜单名称</th>
            <th>所属菜单</th>
            <th>路由</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
        <tr data-id="{{$menu->id}}">
            <td>{{$menu->name}}</td>
            <td>{{$menu->parent_name}}</td>
            <td>{{$menu->my_route}}</td>
            <td>{{$menu->sort}}</td>
            <td>
                &emsp;<a href="{{route('menu.edit',['menu'=>$menu])}}" class="btn btn-warning">编辑</a>
                &emsp;<a href="" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{--{{$menus->appends($queries)->links()}}--}}
@stop

@section('js')
    <script type="text/javascript">
        $(".btn-danger").click(function () {
            if (confirm('确认删除该数据,删除后无法恢复')){
                var tr=$(this).closest('tr');
                var id=tr.data('id')
                $.ajax({
                    type:"DELETE",
                    url:'menu/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function (msg) {
                        tr.remove();
                    }
                });
            }
        });
    </script>
    @stop