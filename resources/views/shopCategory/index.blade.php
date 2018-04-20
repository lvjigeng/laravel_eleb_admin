@extends('layout.default')
@section('title','店铺分类')

@section('content')
    <a href="{{route('shopCategory.create')}}" class="btn btn-default">添加</a>
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>分类名</th>
            <th>图片</th>
            <th>操作</th>
        </tr>
        @foreach($shopCategories as $category)
            <tr data-id="{{$category->id}}">
                <td>{{ $category->id}}</td>
                <td>{{$category->name}}</td>
                <td><img src="{{\Illuminate\Support\Facades\Storage::url($category->img)}}" alt="" class="img-thumbnail" width="70px"></td>
                <td>
                    <a href="{{route('shopCategory.edit',['val'=>$category])}}" class="btn btn-default">编辑</a>
                    &emsp;<a href="" class="btn btn-danger">删除</a></td>
            </tr>
        @endforeach
    </table>

@stop

@section('js')
    <script>
        $(".btn-danger").click(function () {
            if (confirm('确认删除,删除后将无法恢复')){
                var tr=$(this).closest('tr');
                var id=tr.data('id')
                $.ajax({
                    type:"DELETE",
                    url:'shopCategory/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function (msg) {
                        tr.fadeOut();
                    }
                });
            }
        })
    </script>

@stop