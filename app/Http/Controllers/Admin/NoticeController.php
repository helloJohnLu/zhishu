<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendMessage;
use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * 通知列表
     *
     * @return
     */
    public function index()
    {
        $notices = Notice::all();
        return view('admin/notice/index', compact('notices'));
    }

    /**
     * 创建通知
     *
     * @return
     */
    public function create()
    {
        return view('admin/notice/create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $notice = Notice::create($request->all(['title', 'content']));

        // 分发通知
        dispatch(new SendMessage($notice));

        return redirect()->route('notices.index');
    }
}
