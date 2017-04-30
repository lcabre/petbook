<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 */
class Post extends Model
{
    protected $table = 'post';

    public $timestamps = true;

    protected $fillable = [
        'id_mascota',
        'id_usuario',
        'titulo',
        'descripcion'
    ];

    protected $guarded = [];

        
}