<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

    protected $table = 'comments';
    public $timestamps = false;

    protected $fillable = [
        'blog_id',
        'content',
        'author_user_id'
    ];
    
    protected $guarded = [
        'id',
    ];

}
