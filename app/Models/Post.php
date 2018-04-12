<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Post extends Model
{
    // 使用软删除
    use SoftDeletes;

    // algolia 全文索引
    use Searchable;

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

    /**
     * 定义该模型索引的名称
     * @return string
     */
    public function searchableAs()
    {
        return 'posts_index';
    }

    /**
     * 定义该模型可索引的数据
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [
            'title'     =>  $this->title,
            'content'   =>  $this->content,
        ];

        return $array;
    }

    /**
     * 日期时间格式
     *
     * @param $date
     * @return string|static
     */
    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(15)) {
            return Carbon::parse($date)->toFormattedDateString();
        }

        return Carbon::parse($date)->diffForHumans();
    }

    // 属于某个作者的文章
    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function postTopics()
    {
        return $this->hasMany(\App\Models\PostTopic::class, 'post_id', 'id');
    }

    // 不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave('postTopics', 'and', function ($q) use($topic_id) {
            $q->where('topic_id', $topic_id);
        });
    }
}
