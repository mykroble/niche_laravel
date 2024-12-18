<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class blog_image extends Model
{

    protected $table = 'blog_images';

    protected $fillable = [
        'blog_id',
        'file_path',
        'alt',
        'image_id'
    ];
    
    protected $guarded = [
        'id',
    ];

}
