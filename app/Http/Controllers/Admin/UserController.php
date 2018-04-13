<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // 管理员列表
    public function index()
    {
        return view('admin.user.index');
    }

    // 添加管理员页面
    public function create()
    {
        return view('admin.user.add');
    }

    // 添加管理员
    public function store()
    {
        return ;
    }
}
