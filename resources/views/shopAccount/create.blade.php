@extends('layout.default')

    @section('title','添加店铺')

    @section('content')
        <div class="row">
            <form action="{{route('shopAccount.store')}}" method="post" enctype="multipart/form-data">
                <div class="col-xs-6">
                    账号<input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="手机号"><br>
                    密码<input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="密码"><br>
                    确认密码<input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}" placeholder="确认密码" ><br>
                    邮箱<input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="邮箱"><br>
                    <p><strong>商家详细信息</strong></p>
                    商户名称<input type="text" name="shop_name" class="form-control" value="{{old('shop_name')}}" placeholder="必填"><br>
                    商户分类 <select name="category_id"class="form-control">
                        @foreach($shopCategories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select><br>
                    起送金额<input type="text" name="start_send" class="form-control" value="{{old('start_send')}}" placeholder="必填"><br>
                    配送费<input type="text" name="send_cost" class="form-control" value="{{old('send_cost')}}" placeholder="必填"><br>
                    备注<input type="text" name="notice" class="form-control" value="{{old('notice')}}"><br>
                    优惠信息<textarea name="discount" class="form-control">{{old('discount')}}</textarea><br>

                </div>
                <div class="col-xs-6" style="margin-top: 20px">
                    商户图片 <input type="hidden" id="logo" name="shop_img" class="form-control"  value="">
                    <!--dom结构部分-->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
                    </div>
                    <img src="" id="img" alt="" class="img-rounded" width="150"><br>
                    <span style="color: red">注:必须上传图片,为商家logo</span>
                    <table class="table table-bordered">
                        <tr>
                            <td>是否是品牌</td>
                            <td>
                                <label>
                                    <input type="radio" name="brand" value="1" >是
                                </label>
                                <label>
                                    <input type="radio" name="brand" value="0" checked>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否准时送达</td>
                            <td>
                                <label>
                                    <input type="radio" name="on_time" value="1" >是
                                </label>
                                <label>
                                    <input type="radio" name="on_time" value="0" checked>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否蜂鸟配送</td>
                            <td>
                                <label>
                                    <input type="radio" name="fengniao" value="1" checked>是
                                </label>
                                <label>
                                    <input type="radio" name="fengniao" value="0" checked>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否保标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="bao" value="1" >是
                                </label>
                                <label>
                                    <input type="radio" name="bao" value="0" checked>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否票标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="piao" value="1" >是
                                </label>
                                <label>
                                    <input type="radio" name="piao" value="0" checked>不是
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>是否准标记</td>
                            <td>
                                <label>
                                    <input type="radio" name="zhun" value="1" >是
                                </label>
                                <label>
                                    <input type="radio" name="zhun" value="0" checked>不是
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" value="注册" class="btn btn-primary btn-lg"></td>


                        </tr>

                    </table>
                </div>
                {{ csrf_field() }}
            </form>
        </div>

    @stop
@section('js')
    <!--引入webUploader的JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script type="text/javascript">
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            formData:{'_token':"{{csrf_token()}}",'dir':"public/shopImg"},

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });



        uploader.on( 'uploadSuccess', function( file,response ) {
//                $( '#'+file.id ).addClass('upload-state-done');
            var url=response.url;
            $('#img').attr('src',url);
            $('#logo').val(url);
        });
    </script>
@stop