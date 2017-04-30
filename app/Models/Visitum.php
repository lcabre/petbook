<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Visitum
 */
class Visitum extends Model
{
    protected $table = 'visita';

    public $timestamps = true;

    protected $fillable = [
        'id_post'
    ];

    protected $guarded = [];

        
}