<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // 用户的文章列表
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class, 'user_id', 'id');
    }

    // 我的粉丝
    public function fans()
    {
        return $this->hasMany(\App\Models\Fan::class, 'star_id', 'id');
    }

    // 关注用户列表
    public function followers()
    {
        return $this->hasMany(\App\Models\Fan::class, 'fan_id', 'id');
    }

    // 我关注某人
    public function follow($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->followers()->save($fan);
    }

    // 取消关注
    public function unFollow($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->followers()->delete($fan);
    }

    // 当前用户是否被uid关注了
    public function beFollowed($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    // 当前用户是否关注了uid
    public function isFollowing($uid)
    {
        return $this->followers()->where('star_id', $uid)->count();
    }
}
