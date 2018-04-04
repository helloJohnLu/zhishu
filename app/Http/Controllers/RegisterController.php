<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 用户注册页面
    public function index()
    {
        return view('register.register');
    }

    /**
     * 用户注册
     *
     * @param RegisterRequest $request    数据校验
     * @return 跳转到登录页面
     */
    public function store(RegisterRequest $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));

        User::create(compact('name', 'email', 'password'));

        session()->flash('success', '您已成功注册，现在可以登录了。');

        return redirect()->route('login.index');
    }
}
