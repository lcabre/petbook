<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Raza
 */
class Raza extends Model
{
    protected $table = 'raza';

    public $timestamps = true;

    protected $fillable = [
        'id_tipo_mascota',
        'nombre'
    ];

    protected $guarded = [];

        
}