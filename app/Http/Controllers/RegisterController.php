<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 用户注册页面
    public function index()
    {
        return view('register.register');
    }

    // 处理注册表单提交
    public function store()
    {
        //
    }
}
