<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Foto
 */
class Foto extends Model
{
    protected $table = 'foto';

    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];

    protected $guarded = [];

        
}