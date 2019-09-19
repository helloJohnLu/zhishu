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
                <form class="navbar-form navbar-left" action="{{ route('search') }}">
                    <div class="form-group">
                        <input type="text" class="form-control input-md" name="query" id="searchinput" placeholder="Search" required>
                    </div>
                    <button type="submit" class="btn btn-md btn-info">Go!</button>
                </form>
            </li>
        </ul>

        @if(Auth::check())
            <ul class="nav navbar-nav navbar-right" style="padding-top: 5px;">
                <li class="dropdown">
                    <div>
                        <img src="{{ asset(Auth::user()->avatar) }}" alt="" class="img-rounded" style="border-radius:100%; width: 30px; height: 30px;">
                        <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }}  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('user.show', Auth::id()) }}">我的主页</a></li>
                            <li><a href="{{ route('user.settingStore') }}">个人设置</a></li>
                            <li><a href="{{ route('logout') }}">登出</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        @else
            <div class="btn-group nav navbar-nav navbar-right" style="margin-top: 7px;">
                <a href="{{ route('register.index') }}" class="btn btn-warning">注册</a>
                <a href="{{ route('login') }}" class="btn btn-success">登录</a>
            </div>
        @endif
    </div>
</div>