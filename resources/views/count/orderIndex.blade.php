@extends('layout.default')

    @section('title','订单统计详情')

    @section('content')


                    <h1>订单数量统计</h1>
                    <form class="form-inline" method="get" action="{{route('count.orderIndex')}}">
                        <div class="form-group">

                            <input type="date" class="form-control" name="date" value="{{$date}}">
                        </div>

                        <button type="submit" class="btn btn-info">查看</button>
                    </form>

            <div class="row">
                <div class="col-xs-4">
                    <table class="table table-hover">
                        <tr>
                            <th colspan="2">日排行榜</th>

                        </tr>
                        <tr>
                            <th>店铺名</th>
                            <th>订单量</th>
                        </tr>
                        @foreach($orderDay as $day)
                        <tr>
                            <td>{{$day->shop_name}}</td>
                            <td>{{$day->total}}</td>
                        </tr>
                        @endforeach

                    </table>
                </div>

                <div class="col-xs-4">
                    <table class="table table-hover">
                        <tr>
                            <th colspan="2">月排行榜</th>

                        </tr>
                        <tr>
                            <th>店铺名</th>
                            <th>订单量</th>
                        </tr>
                        @foreach($orderMonth as $month)
                            <tr>
                                <td>{{$month->shop_name}}</td>
                                <td>{{$month->total}}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>

                <div class="col-xs-4">
                    <table class="table table-hover">
                        <tr>
                            <th colspan="2">总排行榜</th>

                        </tr>
                        <tr>
                            <th>店铺名</th>
                            <th>订单量</th>
                        </tr>
                        @foreach($orderTotal as $total)
                            <tr>
                                <td>{{$total->shop_name}}</td>
                                <td>{{$total->total}}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
    @stop
