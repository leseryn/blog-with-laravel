<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostComment extends Model
{
    use SoftDeletes;
    
    protected $table = 'post_comment';

    protected $primaryKey = 'id';

    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'parent_id',
        'created_at',
    ];

    // protected $with = ['user:id,name,display_name,profile_image_path','childComment'];

    // public function post()
    // {
    //     return $this->belongsTo(BlogPost::class,'post_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function post()
    {
        return $this->belongsTo(BlogPost::class,'post_id');
    }


    public function childComments()
    {
        return $this->hasMany(PostComment::class,'parent_id')->orderBy('created_at','asc');
        // return $this->hasMany(PostComment::class,'parent_id')->where('parent_id','=',null);
    }


}
