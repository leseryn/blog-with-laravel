<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_image';

    protected $primaryKey = 'id';

    protected $fillable = [
        'post_id',
        'image_path',
        'image_caption',
        'created_at',
    ];

    public $timestamps = ["created_at"]; //only want to used created_at column
    const UPDATED_AT = null; //and updated by default null set

    protected $hidden = [
        
    ];


    protected $casts = [

    ];

    public function post()
    {
        return $this->belongsTo(BlogPost::class,'post_id');
    }
}
