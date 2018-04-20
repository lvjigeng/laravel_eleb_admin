@extends('layout.default')
    @section('title',$shopAccount->shopDetail->shop_name)

    @section('content')
        <div class="row">
            <form action="" method="post">
                <div class="col-xs-6">
                    商户名称<input type="text" name="shop_name" class="form-control" value="{{$shopAccount->shopDetail->shop_name}}" disabled><br>
                    商家分类 <select name="shopCategory_id" class="form-control" disabled>
                        @foreach($shopCategories as $shopCategory)
                        <option value="{{$shopCategory->id}}" {{$shopAccount->shopDetail->shopCategory_id==$shopCategory->id?'checked':''}}>{{$shopCategory->name}}</option>
                        @endforeach
                    </select><br>
                    起送金额<input type="text" name="start_send" class="form-control" value="{{$shopAccount->shopDetail->start_send}}" disabled><br>
                    配送费<input type="text" name="send_cost" class="form-control" value="{{$shopAccount->shopDetail->send_cost}}" disabled><br>
                    备注<input type="text" name="notice" class="form-control" value="{{$shopAccount->shopDetail->notice}}" disabled><br>
                    优惠信息<textarea name="discount" class="form-control" disabled>{{$shopAccount->shopDetail->discount}}</textarea><br>
                    商户图片 <img src="{{$shopAccount->shopDetail->shop_img}}" alt="" class="img-thumbnail" width="90px"><br>
                </div>
                <div class="col-xs-6" style="margin-top: 20px">
                    <table class="table table-bordered">
                        <tr>
                            <td>是否是品牌</td>
                            <td>
                                <label>
                                    <input type="radio" name="brand" value="1" {{$shopAccount->shopDetail->brand==1?'checked':''}} disabled>是
                                </label>
                                <label>
                                    <input type="radio" name="brand" value="0" {{$shopAccount->shopDetail->brand==0?'checked':''}} disabled>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否准时送达</td>
                            <td>
                                <label>
                                    <input type="radio" name="on_time" value="1" {{$shopAccount->shopDetail->zhun==1?'checked':''}} disabled>是
                                </label>
                                <label>
                                    <input type="radio" name="on_time" value="0" {{$shopAccount->shopDetail->on_time==0?'checked':''}} disabled>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否蜂鸟配送</td>
                            <td>
                                <label>
                                    <input type="radio" name="fengniao" value="1" {{$shopAccount->shopDetail->fengniao==1?'checked':''}} disabled>是
                                </label>
                                <label>
                                    <input type="radio" name="fengniao" value="0" {{$shopAccount->shopDetail->fengniao==0?'checked':''}} disabled>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否保标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="bao" value="1" {{$shopAccount->shopDetail->bao==1?'checked':''}} disabled>是
                                </label>
                                <label>
                                    <input type="radio" name="bao" value="0" {{$shopAccount->shopDetail->bao==0?'checked':''}} disabled>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否票标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="piao" value="1" {{$shopAccount->shopDetail->piao==1?'checked':''}} disabled>是
                                </label>
                                <label>
                                    <input type="radio" name="piao" value="0" {{$shopAccount->shopDetail->piao==0?'checked':''}} disabled>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否准标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="zhun" value="1" {{$shopAccount->shopDetail->zhun==1?'checked':''}} disabled>是
                                </label>
                                <label>
                                    <input type="radio" name="zhun" value="0" {{$shopAccount->shopDetail->zhun==0?'checked':''}} disabled>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <div class="row">

                                        @if($shopAccount->status==0)
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <a href="{{route('pass',['shopAccount'=>$shopAccount])}}" class="btn btn-info">审核通过</a>
                                                </div>
                                                @else
                                                    <div class="col-xs-3">
                                                        <a href="{{route('disabled',['shopAccount'=>$shopAccount])}}" class="btn btn-danger">账号禁用</a>
                                                    </div>
                                                @endif
                                            </div>


                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="{{route('shopAccount')}}" class="btn btn-info">返回</a></td>
                        </tr>
                    </table>
                </div>
                {{ csrf_field() }}
            </form>



        </div>

    @stop