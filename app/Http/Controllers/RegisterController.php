<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 用户注册页面
    public function index()
    {
        // 如果用户已登录
        if (\Auth::check()) {
            return redirect()->route('posts.index');
        }

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
        $code = $request->get('code');

        if (\Session::get('code') != $code) {
            return back()->withErrors('验证码不正确');
        }

        $name = $request->get('name');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));

        User::create(compact('name', 'email', 'password'));

        session()->flash('success', '您已成功注册，现在可以登录了。');

        return redirect()->route('login');
    }

    /**
     * 验证码
     *
     * @return mixed
     */
    public function code()
    {
        $phrase = new PhraseBuilder();
        $code = $phrase->build(4);

        // 实例化
        $builder = new CaptchaBuilder($code, $phrase);

        $builder->build(102,35);

        // 获取验证码的内容
        $phrase = $builder->getPhrase();

        // 把内容存入session
        \Session::flash('code', $phrase);

        ob_end_clean();
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }
}
