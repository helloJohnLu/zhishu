@extends('layouts.main')

@section('content')
    <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{ $post->title }}</h2>
                    @can('update', $post)
                        <a style="margin: auto;margin-left: 10px;"  href="{{ route('posts.edit', $post->id) }}">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                    @endcan
                    @can('delete', $post)
                        <a style="margin: auto;margin-left: 10px;" href="javascript:;" onclick="deletePost()">
                            <span class="glyphicon glyphicon-remove" style="color: red" aria-hidden="true"></span>
                        </a>
                    @endcan
                </div>

                <p class="blog-post-meta">
                    {{ $post->created_at->toFormattedDateString() }} by <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a>
                </p>

                {!! $post->content !!}
                <div>
                    @if($post->zan(Auth::id())->exists())
                    <a href="/posts/{{ $post->id }}/unzan" type="button" class="btn btn-default btn-md">取消赞</a>
                    @else
                    <a href="/posts/{{ $post->id }}/zan" type="button" class="btn btn-success btn-md">赞</a>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">评论</div>

                <!-- List group -->
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <h5>{{ $comment->created_at }} by {{ $comment->user->name }}</h5>
                            <div>
                                {!! $comment->content !!}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表评论</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                        {{ csrf_field() }}
                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            @include('messages.errors')
                            <button class="btn btn-default" type="submit" style="margin-top: 5px;">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div>
@stop

@section('script')
    <script>
        function deletePost() {
            //询问框
            layer.confirm('确定要删除此文章吗？', {
                btn: ['确定','取消操作'] //按钮
            }, function(){
                // 跳转到文章列表页
                posts = "{{ route('posts.index') }}";

                // ajax 删除
                $.post('{{ route("posts.destroy", $post->id) }}',{ '_token':'{{csrf_token() }}', '_method':'DELETE'}, function (data) {
                    if(data.status === 1){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout('location.href = posts',2000);
                    }else{
                        layer.msg(data.msg,  {icon: 5});
                        setTimeout('location.href = location.href',2000);
                    }
                });
            }, function(){
                //
            });
        }
    </script>
@stop