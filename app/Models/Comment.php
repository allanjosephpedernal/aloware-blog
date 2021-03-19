<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function replies()
    {
        return $this->hasMany(Comment::class,'reply_id','id');
    }
}
