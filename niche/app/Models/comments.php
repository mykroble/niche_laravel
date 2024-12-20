<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

    protected $table = 'comments';

    protected $fillable = [
        'blog_id',
        'author_user_id',
        'content',
    ];
    
    protected $guarded = [
        'id',
    ];

}
