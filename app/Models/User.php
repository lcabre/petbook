<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 */
class User extends Model
{
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'password',
        'ultima_conexion',
        'usercol',
        'remember_token'
    ];

    protected $guarded = [];

        
}