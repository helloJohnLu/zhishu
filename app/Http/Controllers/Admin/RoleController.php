<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminPermission;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //
    public function index()
    {
        $roles = AdminRole::paginate(10);
        return view('admin/role/index', compact('roles'));
    }

    // 创建角色页面
    public function create()
    {
        return view('admin/role/add');
    }

    // 创建角色
    public function store()
    {
        $this->validate(\request(), [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);

        AdminRole::create(\request(['name', 'description']));

        return redirect()->route('role.index');
    }

    // 角色 & 权限 页面
    public function permission(AdminRole $role)
    {
        // 获取所有权限
        $permissions = AdminPermission::all();

        // 获取当前权限
        $myPermissions = $role->permissions;

        return view('admin/role/permission', compact('permissions', 'myPermissions', 'role'));
    }

    //
    public function storePermission(AdminRole $role)
    {
        $this->validate(\request(), [
            'permissions' => 'required|array'
        ]);

        $permissions = AdminPermission::findMany(\request('permissions'));
        $myPermissions = $role->permissions;

        // 对已经有的权限
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }

        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role -> deletePermission($permission);
        }

        return back();
    }
}
