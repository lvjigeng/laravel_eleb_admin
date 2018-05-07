@extends('layout.default')

    @section('title','菜品销售量统计')

    @section('content')



                <h1>菜品销售量统计</h1>
                <form class="form-inline" method="get" action="{{route('count.foodsIndex')}}">
                    <div class="form-group">

                        <input type="date" class="form-control" name="date" value="{{$date}}">
                    </div>

                    <button type="submit" class="btn btn-info">查看</button>
                </form>
                <div class="row">
                    <div class="col-xs-4">
                <table class="table table-hover ">
                <tr>
                    <th colspan="2">日销售</th>
                </tr>
                <tr>
                    <th>店铺</th>
                    <th>名称</th>
                    <th>数量</th>


                </tr>
                @foreach($foodsDay as $food)
                <tr>
                    <td >{{$food->shop_name}}</td>
                    <td >{{$food->goods_name}}</td>
                    <td >{{$food->total}}</td>
                </tr>
                @endforeach
                </table>
                    </div>

                    <div class="col-xs-4">
                        <table class="table table-hover ">
                            <tr>
                                <th colspan="2">月销售</th>
                            </tr>
                            <tr>
                                <th>店铺</th>
                                <th>名称</th>
                                <th>数量</th>


                            </tr>
                            @foreach($foodsMonth as $food)
                                <tr>
                                    <td >{{$food->shop_name}}</td>
                                    <td >{{$food->goods_name}}</td>
                                    <td >{{$food->total}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <div class="col-xs-4">
                        <table class="table table-hover ">
                            <tr>
                                <th colspan="2">总销售</th>
                            </tr>
                            <tr>
                                <th>店铺</th>
                                <th>名称</th>
                                <th>数量</th>


                            </tr>
                            @foreach($foodsTotal as $food)
                                <tr>
                                    <td >{{$food->shop_name}}</td>
                                    <td >{{$food->goods_name}}</td>
                                    <td >{{$food->total}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>


    @stop

