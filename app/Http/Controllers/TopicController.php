<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    //  专题详情
    public function show(Topic $topic)
    {
        return view('topic.show');
    }

    // 投稿
    public function submit(Topic $topic)
    {
        return ;
    }

}
