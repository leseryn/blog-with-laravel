<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserFollow extends Model
{
    use SoftDeletes;

    protected $table = 'user_follow';

    public $timestamps = null;



    protected $fillable = [
        'user_id',
        'following_user_id',
    ];
}
