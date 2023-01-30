<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{

    protected $table = 'post_comment';

    protected $primaryKey = 'id';

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'parent_id',
        'created_at',
    ];

    protected $with = ['user','childComment'];

    // public function post()
    // {
    //     return $this->belongsTo(BlogPost::class,'post_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    // public function parentComment()
    // {
    //     return $this->belongsTo(PostComment::class,'parent_id');
    // }

    public function childComment()
    {
        return $this->hasMany(PostComment::class,'parent_id')->orderBy('created_at','asc');
        // return $this->hasMany(PostComment::class,'parent_id')->where('parent_id','=',null);
    }

    public function likes(){
        return $this->hasMany(UserLikePost::class, 'comment_id')->count();
    }

}