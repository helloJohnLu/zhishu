@extends('layouts.main')

@section('content')
<div class="col-sm-8">
    <blockquote>
        <p><img src="{{ $user->avatar }}" alt="" class="img-rounded" style="border-radius:100%; width: 60px; height: 60px"> {{ $user->name }}
        </p>
        <footer>关注：{{ $user->followers_count }}｜粉丝：{{ $user->fans_count }}｜文章：{{ $user->posts_count }}</footer>
        @include('user.badges.like', ['target_user' => $user])
    </blockquote>
</div>
<div class="col-sm-8 blog-main">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">
                            <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a>
                            {{ $post->created_at }}
                        </p>
                        <p class="">
                            <a href="{{ route('posts.show', $post->id) }}" >{{ $post->title }}</a>
                        </p>
                        @if(strlen(\Illuminate\Support\Str::words($post->content, 1)) > 102)
                            {!! str_limit($post->content, 102, '......') !!}
                        @else
                            {!! \Illuminate\Support\Str::words($post->content, 1) !!}
                        @endif
                    </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                @foreach($starUsers as $user)
                    <div class="blog-post" style="margin-top: 30px">
                    <p class="">
                        <a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a>
                    </p>
                    <p class="">关注：{{ $user->followers_count }} | 粉丝：{{ $user->fans_count }}｜ 文章：{{ $user->posts_count }}</p>
                    @include('user.badges.like', ['target_user' => $user])
                </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                @foreach($fanUsers as $user)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">
                            <a href="{{ route('user.show',$user->id) }}">{{ $user->name }}</a>
                        </p>
                        <p class="">关注：{{ $user->follwers_count }} | 粉丝：{{ $user->fans_count }}｜ 文章：{{ $user->posts_count }}</p>
                    @include('user.badges.like', ['target_user' => $user])
                    </div>
                @endforeach
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
</div>
@stop