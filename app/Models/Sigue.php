<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sigue
 */
class Sigue extends Model
{
    protected $table = 'sigue';

    public $timestamps = true;

    protected $fillable = [
        'id_usuario_2',
        'id_mascota',
        'id_usuario'
    ];

    protected $guarded = [];

        
}