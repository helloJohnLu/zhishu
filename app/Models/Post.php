<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // 使用软删除
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    // 模型关联，文章关联用户
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // 评论模型
    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('created_at', 'desc');
    }

    // 文章与赞模型 关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Models\Zan::class)->where('user_id', $user_id);
    }

    // 所有赞的数量
    public function zans()
    {
        return $this->hasMany(\App\Models\Zan::class);
    }
}
