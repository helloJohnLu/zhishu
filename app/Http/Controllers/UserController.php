<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 用户个人设置页面
    public function setting()
    {
        return view('user.setting');
    }

    /**
     * 用户个人设置表单提交处理
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|string
     */
    public function settingStore(Request $request)
    {
        // 验证
        $this->validate($request, [
            'name'      =>  'required|min:2',
            'avatar'    =>  'image|dimensions:max_width=800,max_height=600',
        ],[
            'avatar.dimensions' =>  '图片的尺寸不能超过 800 * 600 像素'
        ]);

        // 逻辑
        $name = $request->get('name');
        $user = \Auth::user();
        if ($name != $user->name) {     // 判断用户名是否有更改
            if (User::where('name', $name)->count() > 0) {  // 判断用户名是否已存在
                return back()->withErrors('用户名已经被注册');
            }
            $user->name = $name;
        }

        if ($request->file('avatar')) {     // 判断是否有上传头像图片
            $path = Storage::putFile('avatar/' . date('Ym', time()) . '/' . date('d', time()), $request->file('avatar'));
            $user->avatar = "/storage/" . $path;
        }

        $user->save();

        session()->flash('success', '更新用户资料成功');

        return back();
    }

    // 个人中心
    public function show(User $user)
    {
        // 向视图传递个人信息，包括：关注 / 粉丝 / 文章数
        $user = User::withCount(['fans', 'followers', 'posts'])->find($user->id);  // User.php 中定义的模型关联

        // 文章列表，取创建时间最新的前 10 条
        $posts = $user->posts()->orderBy('created_at', 'desc')->take(10)->get();

        // 关注的用户，包括关注用户的 关注 / 粉丝 / 文章数
        $followers = $user->followers;
        $starUsers = User::whereIn('id', $followers->pluck('star_id'))
                        ->withCount(['followers', 'fans', 'posts'])
                        ->get();

        // 粉丝用户，包含粉丝用户的 关注 / 粉丝 / 文章数
        $fans = $user->fans;
        $fanUsers = User::whereIn('id', $fans->pluck('fan_id'))
                        ->withCount(['followers', 'fans', 'posts'])
                        ->get();

        return view('user.show', compact('user', 'posts', 'starUsers', 'fanUsers'));
    }

    // 关注用户
    public function follow(User $user)
    {
        $me = \Auth::user();    // 当前用户
        $me->follow($user->id);  // 关注用户

        return [
            'error'     =>  0,
            'message'   =>  ''
        ];
    }

    // 取消关注
    public function unFollow(User $user)
    {
        $me = \Auth::user();        // 当前用户
        $me->unFollow($user->id);    // 取消关注
        return [
            'error'     =>  0,
            'message'   =>  ''
        ];
    }
}
