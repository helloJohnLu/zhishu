<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // 文章列表
    public function index()
    {
        return view('admin.post.index');
    }

    // 文章审核
    public function status(Post $post)
    {
        return ;
    }
}
