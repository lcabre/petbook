<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AptoCitum
 */
class AptoCitum extends Model
{
    protected $table = 'apto_cita';

    public $timestamps = true;

    protected $fillable = [
        'id_mascota',
        'id_usuario',
        'id_raza',
        'tamanio',
        'radio_km'
    ];

    protected $guarded = [];

        
}