<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /**
     * 用户登录页面
     *
     * @return
     */
    public function index()
    {
        return view('login.login');
    }

    /**
     * 处理登录表单提交
     *
     * @param LoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = $request->except('_token');
        $is_remember = boolval($request->get('is_remember'));

        if (\Auth::attempt($user, $is_remember)) {
            return redirect()->route('posts.index');
        }

        return back()->withErrors('邮箱与密码不匹配！');
    }

    /**
     * 登出
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        \Auth::logout();
        session()->flash('success', '您已登出！');

        return redirect()->route('login.index');
    }
}
