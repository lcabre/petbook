<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_user
 * @property string $nombre
 * @property string $domicilio
 * @property string $telefono
 * @property string $geoposicion
 * @property string $sexo
 * @property string $fecha_nacimiento
 * @property string $updated_at
 * @property string $created_at
 * @property User $user
 * @property Adopta[] $adoptas
 * @property FotoPerfil[] $fotoPerfils
 * @property Mascota[] $mascotas
 * @property Sigue[] $sigues
 */
class Usuario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usuario';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'nombre', 'domicilio', 'telefono', 'geoposicion', 'sexo', 'fecha_nacimiento', 'updated_at', 'created_at'];
    protected $dates = ['fecha_nacimiento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adoptas()
    {
        return $this->hasMany('App\Adopta', 'id_usuario_2');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotoPerfils()
    {
        return $this->hasMany('App\FotoPerfil', 'id_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mascotas()
    {
        return $this->hasMany('App\Mascota', 'id_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sigues()
    {
        return $this->hasMany('App\Sigue', 'id_usuario_2');
    }
}
