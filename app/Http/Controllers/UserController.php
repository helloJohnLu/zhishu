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
        return view('user.show', compact('user'));
    }

    // 关注用户
    public function fan()
    {
        return;
    }

    // 取消关注
    public function unfan()
    {
        return;
    }
}
