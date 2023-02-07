<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BlogPost extends Model
{

    use SoftDeletes;
    protected $table = 'blog_post';

    protected $primaryKey = 'id';


    protected $fillable = [
        'user_id',
        'title',
        'summary',
        'content',
        'created_at',
        'updated_at',
        'published',
    ];



    protected $hidden = [
        
    ];


    protected $casts = [

    ];

    protected $with = ['user:id,name,display_name,profile_image_path,profile_text',
                        'images',
                        'comments',
                        'likes',
                        'commentsAll'];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function images(){
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function comments(){
        return $this->hasMany(PostComment::class, 'post_id')->where('parent_id','=',null);
    }
    public function commentsAll(){
        return $this->hasMany(PostComment::class, 'post_id');
    }

    public function likes(){
        return $this->hasMany(UserLikePost::class, 'post_id');
    }



}
