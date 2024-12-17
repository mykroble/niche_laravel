<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_channel extends Model
{

    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'channel_id',
        'date_added'
    ];

    protected $guarded = [
        'id'
    ];
}
