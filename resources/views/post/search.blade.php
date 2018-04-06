@extends('layouts.main')

@section('content')
    <div class="alert alert-success" role="alert">
        下面是搜索『 {{ $query }} 』出现的文章，共 {{ $posts->total() }} 条
    </div>

    <div class="col-sm-8 blog-main">
        @foreach($posts as $post)
        <div class="blog-post">
            <h2 class="blog-post-title"><a href="{{ route('posts.show', $post->id) }}" >{{ $post->title }}</a></h2>
            <p class="blog-post-meta">
                {{ $post->created_at->toFormattedDateString() }} by <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a>
            </p>
            <p>
                @if(strlen(\Illuminate\Support\Str::words($post->content, 1)) > 102)
                    {!! str_limit($post->content, 102, '......') !!}
                @else
                    {!! \Illuminate\Support\Str::words($post->content, 1) !!}
                @endif
            </p>
        </div>
        @endforeach
        {!! $posts->render() !!}
    </div>
@stop