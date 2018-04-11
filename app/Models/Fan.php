<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    // 粉丝用户
    public function FanUser()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'fan_id');
    }

    // 被关注用户
    public function StarUser()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'star_id');
    }
}
