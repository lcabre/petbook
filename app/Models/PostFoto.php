<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostFoto
 */
class PostFoto extends Model
{
    protected $table = 'post_foto';

    public $timestamps = true;

    protected $fillable = [
        'id_post',
        'id_foto'
    ];

    protected $guarded = [];

        
}