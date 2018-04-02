<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 文章列表
    public function index()
    {
        return view('post.index');
    }

    // 文章创建
    public function create()
    {
        return view('post.create');
    }

    // 表单提交处理
    public function store(Request $request)
    {
        //
    }

    // 文章详情
    public function show($id)
    {
        return view('post.show');
    }

    // 文章编辑
    public function edit($id)
    {
        return view('post.edit');
    }

    // 文章更新 表单处理
    public function update(Request $request, $id)
    {
        //
    }

    // 文章删除
    public function destroy($id)
    {
        //
    }
}
