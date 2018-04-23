<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">后台管理系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{route('shopAccount')}}">店铺管理 <span class="sr-only">(current)</span></a></li>
                <li><a href="{{route('shopCategory.index')}}">分类管理</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">更多 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">消费记录</a></li>

                        <li><a href="">管理员列表</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" method="get" action="@yield('search')">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="keywords">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="">关于我们</a></li>
                @guest
                <li><a href="">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">修改个人信息</a></li>
                        <li><a href="{{route('editPwd',['admin'=>\Illuminate\Support\Facades\Auth::user()])}}">修改密码</a></li>
                            <form action="{{route('logout')}}" method="post">
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                                <button class="btn btn-link">注销</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
