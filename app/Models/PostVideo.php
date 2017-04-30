<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostVideo
 */
class PostVideo extends Model
{
    protected $table = 'post_video';

    public $timestamps = true;

    protected $fillable = [
        'id_post',
        'id_video'
    ];

    protected $guarded = [];

        
}