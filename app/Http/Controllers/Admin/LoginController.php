<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // 登录页面
    public function index()
    {
        // 让已登录用户不能访问登录页
        if (\Auth::guard('admin')->user()) {
            return redirect()->route('adminHome.index');
        }

        return view('admin.login.index');
    }

    // 登录处理
    public function login(Request $request)
    {
        // 验证
        $this->validate($request, [
            'email'  =>  'required|email',
            'password' => 'required'
        ]);

        // 逻辑
        $user['email'] = $request->get('email');
        $user['password'] = $request->get('password');
        if (\Auth::guard('admin')->attempt($user)) {
            return redirect()->route('adminHome.index');
        }

        // 渲染
        return redirect()->back()->withErrors('用户名与密码不匹配');
    }

    // 登出
    public function logout()
    {
        \Auth::guard('admin')->logout();

        return redirect()->route('adminLogin.index');
    }
}
