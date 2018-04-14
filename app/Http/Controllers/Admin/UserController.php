<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminUser;
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
        $users = AdminUser::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    // 添加管理员页面
    public function create()
    {
        return view('admin.user.add');
    }

    // 添加管理员
    public function store(Request $request)
    {
        // 验证数据
        $this->validate($request, [
            'name' => 'required|min:2|max:20',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 逻辑
        $name = $request->get('name');
        $email = $request->get('email');
        $password = bcrypt($request->get('password'));
        AdminUser::create(compact('name', 'email', 'password'));

        return redirect()->route('adminUser.index');
    }
}
