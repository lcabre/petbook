<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $ultima_conexion
 * @property string $updated_at
 * @property string $created_at
 * @property string $remember_token
 * @property Usuario[] $usuario
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ultima_conexion', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuario()
    {
        return $this->hasMany('App\Usuario', 'id_user');
    }

    /**
     *
     */
    public function updateLastConnection(){
        $this->ultima_conexion = Carbon::now();
        $this->save();
    }


    /**
     * @return false|Usuario
     */
    public function addPerfil(){
        $perfil = new Usuario();
        return $this->usuario()->save($perfil);
    }

    /**
     * @return false|Usuario
     */
    public function getPerfil(){
        if(!$this->usuario()->first())
            return $this->addPerfil();

        return $this->usuario()->first();
    }
}

