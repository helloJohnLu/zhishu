<div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">


    <aside id="widget-welcome" class="widget panel panel-default">
        <div class="panel-heading">
            欢迎！
        </div>
        <div class="panel-body">
            <p>
                欢迎来到 <strong><a href="/">知 · 书 社区</a></strong>
            </p>
            <p>
                在这里，你可以分享你的所见、所知、所闻，并与兴趣相同的朋友互动交流。
            </p>
            <p>
                每天通过 知 · 书 创建新的精彩，现在就开始行动吧！
            </p>
        </div>
    </aside>
    <aside id="widget-categories" class="widget panel panel-default">
        <div class="panel-heading">
            专题
        </div>

        <ul class="category-root list-group">
            @foreach($topics as $topic)
                <li class="list-group-item">
                    <a href="/topic/{{ $topic->id }}">{{ $topic->name }}
                    </a>
                </li>
            @endforeach
        </ul>

    </aside>
</div>