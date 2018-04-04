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
}
