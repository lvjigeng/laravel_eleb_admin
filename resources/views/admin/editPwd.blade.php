<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <!--设置标题  默认为首页-->
    <title>修改密码</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    @include('layout._errors')
    @include('layout._messages')
    <div class="modal-dialog modal-sm" role="document" style="margin-top: 170px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">修改密码</h4>
            </div>
            <div class="modal-body">
                <form id="my_login_form" method="post" action="{{route('editPwd',['admin'=>$admin])}}">
                    <div class="form-group">

                        <input type="text" class="form-control" placeholder="手机" name="name" value="{{$admin->phone}}" disabled>
                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control"  placeholder="原密码" name="password">
                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control"  placeholder="新密码" name="new_password">
                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control"  placeholder="确认新密码" name="new_password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" id="my_login_btn">修改</button>
                    {{csrf_field()}}
                </form>
            </div>

        </div>
    </div>
</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="/js/jquery-3.2.1.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="/js/bootstrap.min.js"></script>
<!--设置js-->
@yield('js')
</body>
</html>