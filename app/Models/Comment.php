<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // 评论所属文章
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    // 评论所属用户
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
