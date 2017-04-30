<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Perdida
 */
class Perdida extends Model
{
    protected $table = 'perdida';

    public $timestamps = true;

    protected $fillable = [
        'id_mascota',
        'id_usuario',
        'descripcion'
    ];

    protected $guarded = [];

        
}