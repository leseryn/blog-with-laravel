<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikeComment extends Model
{
    protected $table = 'user_like_comment';
    protected $fillable = [
        'user_id',
        'comment_id',
    ];
}
