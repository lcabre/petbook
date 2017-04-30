<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FotoPerfil
 */
class FotoPerfil extends Model
{
    protected $table = 'foto_perfil';

    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'nombre'
    ];

    protected $guarded = [];

        
}