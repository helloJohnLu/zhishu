<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //
    public function index()
    {
        $permissions = AdminPermission::paginate(10);
        return view('admin/permission/index', compact('permissions'));
    }

    // 创建权限页面
    public function create()
    {
        return view('admin/permission/add');
    }

    // 创建权限
    public function store()
    {
        $this->validate(\request(), [
            'name' => 'required|min:2',
            'description' => 'required'
        ]);

        AdminPermission::create(\request(['name', 'description']));

        return redirect()->route('permission.index');
    }
}
