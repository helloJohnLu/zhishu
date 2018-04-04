<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    // 处理登录表单提交
    public function store()
    {
        //
    }

    // 退出
    public function logout()
    {
        //
    }
}
