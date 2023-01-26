<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'blog_post';

    protected $primaryKey = 'id';


    protected $fillable = [
        'author_id',
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

    protected $with = ['author','images'];
    public function author()
    {
        return $this->belongsTo(User::class,'author_id');
    }

    public function images(){
        return $this->hasMany(PostImage::class, 'post_id');
    }


}
