@extends('layout.default')
@section('title','奖品列表')


@section('content')
    <a href="{{route('activityPrize.create')}}" class="btn btn-default">添加</a>
    <table class="table table-hover">
        <tr>

            <th>奖品名称</th>
            <th>奖品描述</th>
            <th>操作</th>
        </tr>
        @foreach($activityPrizes as $activityPrize)
        <tr data-id="{{$activityPrize->id}}">
            <td>{{$activityPrize->name}}</td>
            <td>{{$activityPrize->description}}</td>

            <td>
                &emsp;<a href="{{route('activityPrize.edit',['activityPrize'=>$activityPrize])}}" class="btn btn-warning">编辑</a>
                &emsp;<a href="" class="btn btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$activityPrizes->appends($queries)->links()}}
@stop

@section('js')
    <script type="text/javascript">
        $(".btn-danger").click(function () {
            if (confirm('确认删除该数据,删除后无法恢复')){
                var tr=$(this).closest('tr');
                var id=tr.data('id')
                $.ajax({
                    type:"DELETE",
                    url:'activityPrize/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function (msg) {
                        tr.remove();
                    }
                });
            }
        });
    </script>
    @stop