<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 */
class Like extends Model
{
    protected $table = 'likes';

    public $timestamps = true;

    protected $fillable = [
        'id_post'
    ];

    protected $guarded = [];

        
}