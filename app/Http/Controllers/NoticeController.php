<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 当前用户收到的 notices
        $user = \Auth::user();  // 获取当前用户

        $notices = $user->notices;  // 已定义了模型关联，使用非函数的形式获取对象

        return view('notice/index', compact('notices'));
    }
}
