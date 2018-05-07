@extends('layout.default')
@section('title','权限列表')


@section('content')
    <a href="{{route('permission.create')}}" class="btn btn-default">添加</a>
    <table class="table table-hover">
        <tr>
            <th>权限名称</th>
            <th>显示名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
        <tr data-id="{{$permission->id}}">
            <td>{{$permission->name}}</td>
            <td>{{$permission->display_name}}</td>
            <td>{{$permission->description}}</td>
            <td>
                &emsp;<a href="{{route('permission.edit',['permission'=>$permission])}}" class="btn btn-warning">编辑</a>
                &emsp;<a href="" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$permissions->appends($queries)->links()}}
@stop

@section('js')
    <script type="text/javascript">
        $(".btn-danger").click(function () {
            if (confirm('确认删除该数据,删除后无法恢复')){
                var tr=$(this).closest('tr');
                var id=tr.data('id')
                $.ajax({
                    type:"DELETE",
                    url:'permission/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function (msg) {
                        tr.remove();
                    }
                });
            }
        });
    </script>
    @stop