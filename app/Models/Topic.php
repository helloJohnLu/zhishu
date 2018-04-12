<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    // 属于某个专题的所有文章    专题 & 文章 多对多
    public function posts()
    {
        $this->belongsToMany(\App\Models\Post::class, 'post_topics', 'topic_id', 'post_id');
    }

    // 专题的文章数, 用于 withCount
    public function postTopics()
    {
        $this->hasMany(\App\Models\PostTopic::class, 'topic_id');
    }
}
