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

    // 用户角色页面
    public function role(AdminUser $user)
    {
        $roles = \App\Models\AdminRole::all();  // 所有角色
        $myRoles = $user->roles;

        return view('admin/user/role', compact('roles', 'myRoles', 'user'));
    }

    //
    public function storeRole(AdminUser $user)
    {
        $this->validate(\request(), [
            'roles' => 'required|array'
        ]);

        $roles = \App\Models\AdminRole::findMany(\request('roles'));
        $myRoles = $user->roles;

        // 要增加的
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role) {
            $user->assignRole($role);
        }

        // 要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role) {
            $user->deleteRole($role);
        }

        return back();
    }
}
