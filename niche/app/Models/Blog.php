<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $table = 'blogs';     //does not need, because file name is already 'blog', but ye

    protected $fillable = [
        'title',
        'content'
    ];

    protected $guarded = [
        'blog_id',
        'auther_id',
        'date_created',
        'date_last_updated',
        'is_public'
    ];

}