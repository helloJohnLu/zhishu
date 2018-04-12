<?php

namespace App\Http\Controllers;

use App\Models\PostTopic;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    //  专题详情
    public function show(Topic $topic)
    {
        // 带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);

        // 专题的文章列表，按照创建时间倒序排列
        $posts = $topic->posts()->orderBy('created_at', 'desc')->take(10)->get();

        // 用户未投稿文章
        $myposts = \App\Models\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        return view('topic.show', compact('topic', 'posts', 'myposts'));
    }

    // 投稿
    public function submit(Topic $topic)
    {
        // 验证表单提交数据
        $this->validate(\request(), [
            'post_ids'      =>  'required|array'
        ]);

        // 逻辑
        $post_ids = \request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id) {
            PostTopic::firstOrCreate(compact('topic_id', 'post_id'));
        }

        return back();
    }

}
