<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 */
class Usuario extends Model
{
    protected $table = 'usuario';

    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'nombre',
        'domicilio',
        'telefono',
        'geoposicion',
        'sexo',
        'fecha_nacimiento'
    ];

    protected $guarded = [];

        
}