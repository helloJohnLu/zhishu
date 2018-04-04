<div class="blog-masthead">
    <div class="container">
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="blog-nav-item " href="{{ route('posts.index') }}"
                   style="font-size: x-large; font-weight: 500;">知 · 书</a>
            </li>
            <li>
                <a class="blog-nav-item" href="{{ route('posts.create') }}">写文章</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/notices">通知</a>
            </li>
            <li>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control input-md" id="searchinput" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-md btn-info" style="margin-left: -52px;">Go!</button>
                </form>
            </li>
        </ul>

        @if(Auth::check())
            <ul class="nav navbar-nav navbar-right" style="padding-top: 5px;">
                <li class="dropdown">
                    <div>
                        <img src="/storage/9f0b0809fd136c389c20f949baae3957/iBkvipBCiX6cHitZSdTaXydpen5PBiul7yYCc88O.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 30px">
                        <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }}  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/user/5">我的主页</a></li>
                            <li><a href="/user/5/setting">个人设置</a></li>
                            <li><a href="{{ route('login.logout') }}">登出</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        @else
            <div class="btn-group nav navbar-nav navbar-right" style="margin-top: 7px;">
                <a href="{{ route('register.index') }}" class="btn btn-warning">注册</a>
                <a href="{{ route('login.index') }}" class="btn btn-success">登录</a>
            </div>
        @endif
    </div>
</div>