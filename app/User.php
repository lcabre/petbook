<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

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
        'name', 'email', 'password', 'ultima_conexion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*protected $validators = Validator::make(
        ["email"] => ["required|email|unique:users"]
    );*/

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
        //dd($this);
        $this->ultima_conexion = Carbon::now();
        $this->save();
    }

    /**
     *
     */
    public function addPerfil($user){
        $perfil = new Usuario();
        $this->usuario()->save($perfil);
        return $perfil;
    }
}

