<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // 文章列表
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);

        return view('post.index', compact('posts'));
    }

    // 文章创建
    public function create()
    {
        return view('post.create');
    }

    // 添加文章表单提交处理
    public function store(CreatePostRequest $request)
    {
        $post = Post::create([
            'title'     =>  $request->get('title'),
            'content'   =>  $request->get('content')
        ]);

        return redirect()->route('posts.index');
    }

    // 文章详情
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
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

    /**
     * 文章图片上传
     *
     * @param Request $request
     * @return string    返回图片路径
     */
    public function imageUpload(ImageUploadRequest $request)
    {
        $path = Storage::putFile(date('Ym', time()) . '/' . date('d', time()), $request->file('wangEditorH5File'));

        return asset('storage/' . $path);
    }
}
