<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLikePost extends Model
{
    use SoftDeletes;

    protected $table = 'user_like_post';

    public $timestamps = null;



    protected $fillable = [
        'user_id',
        'post_id',
    ];


}
