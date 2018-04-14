<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // 文章列表
    public function index()
    {
        // 排除全局scope，仅查询status状态为0的文章数据
        $posts = Post::withoutGlobalScope('available')->where('status', 0)->orderBy('created_at', 'desc')->paginate(8);

        return view('admin.post.index', compact('posts'));
    }

    // 文章审核
    public function status(Post $post)
    {
        $this->validate(request(), [
            'status' => 'required|in: -1,1',
        ]);

        $post->status = request('status');
        $post->save();

        // 返回 json 数据
        return [
            'error' => 0,
            'msg' => ''
        ];
    }
}
