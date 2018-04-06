<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    // 文章列表
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount('comments')->paginate(6);

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
            'content'   =>  $request->get('content'),
            'user_id'   =>  \Auth::id(),
        ]);

        return redirect()->route('posts.index');
    }

    // 文章详情
    public function show(Post $post)
    {
        $post->load('comments');
        return view('post.show', compact('post'));
    }

    // 文章编辑
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * 文章更新 表单处理
     *
     * @param CreatePostRequest $request  数据校验
     * @param Post $post    模型绑定
     * @return      跳转到文章详情页
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        // 权限
        $this->authorize('update', $post);

        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();

        return redirect()->route('posts.show', $post->id);
    }

    // 文章删除
    public function destroy(Post $post)
    {
        // 权限
        $this->authorize('delete', $post);

        // 软删除
        $post->delete();

        if ($post->trashed()) {
            $data = [
                'status'        =>  1,
                'msg'           =>  '文章删除成功'
            ];
        }else{
            $data = [
                'status'        =>  0,
                'msg'           =>  '文章删除失败'
            ];
        }

        return $data;
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

    // 用户评论
    public function comment(Post $post, Request $request)
    {
        // 校验
        $this->validate($request, [
            'content'   =>  'required|min:5|max:500'
        ],[
            'content.required'  =>  '请填写评论内容',
            'content.min'       =>  '为避免无意义的评论，评论内容不能少于5个字',
            'content.max'       =>  '请不要发表内容过长的评论，500 个字为限',
        ]);

        // 逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = $request->get('content');
        $post->comments()->save($comment);

        // 渲染
        return back();
    }
}
