<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mascotum
 */
class Mascotum extends Model
{
    protected $table = 'mascota';

    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_raza',
        'sexo',
        'edad',
        'nombre',
        'otras_caracteristicas',
        'apto_adopcion'
    ];

    protected $guarded = [];

        
}