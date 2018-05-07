@extends('layout.default')
@section('title','权限列表')


@section('content')
    <a href="{{route('role.create')}}" class="btn btn-default">添加</a>
    <table class="table table-hover">
        <tr>
            <th>角色名称</th>
            <th>显示名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
        <tr data-id="{{$role->id}}">
            <td>{{$role->name}}</td>
            <td>{{$role->display_name}}</td>
            <td>{{$role->description}}</td>
            <td>
                <a href="{{route('role.show',['role'=>$role])}}" class="btn btn-info">查看</a>
                &emsp;<a href="{{route('role.edit',['role'=>$role])}}" class="btn btn-warning">编辑</a>
                &emsp;<a href="" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$roles->appends($queries)->links()}}
@stop

@section('js')
    <script type="text/javascript">
        $(".btn-danger").click(function () {
            if (confirm('确认删除该数据,删除后无法恢复')){
                var tr=$(this).closest('tr');
                var id=tr.data('id')
                $.ajax({
                    type:"DELETE",
                    url:'role/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function (msg) {
                        tr.remove();
                    }
                });
            }
        });
    </script>
    @stop