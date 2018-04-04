<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // 用户个人设置页面
    public function setting()
    {
        return view('user.setting');
    }

    // 用户设置表单提交
    public function settingStore()
    {
        //
    }
}
