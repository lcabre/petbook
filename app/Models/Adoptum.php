<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Adoptum
 */
class Adoptum extends Model
{
    protected $table = 'adopta';

    public $timestamps = true;

    protected $fillable = [
        'id_mascota',
        'id_usuario',
        'id_usuario_2'
    ];

    protected $guarded = [];

        
}