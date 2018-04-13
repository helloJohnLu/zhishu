<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // 登录页面
    public function index()
    {
        return view('admin.login.index');
    }

    // 登录处理
    public function login()
    {
        return 'login';
    }

    // 登出
    public function logou()
    {
        //
    }
}
