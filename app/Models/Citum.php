<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Citum
 */
class Citum extends Model
{
    protected $table = 'cita';

    public $timestamps = true;

    protected $fillable = [
        'id_mascota',
        'id_usuario',
        'id_mascota_2',
        'id_usuario_2'
    ];

    protected $guarded = [];

        
}