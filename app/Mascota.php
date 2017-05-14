<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $id_raza
 * @property string $sexo
 * @property integer $edad
 * @property string $nombre
 * @property string $otras_caracteristicas
 * @property boolean $apto_adopcion
 * @property string $updated_at
 * @property string $created_at
 * @property Usuario $usuario
 * @property Raza $raza
 */
class Mascota extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mascota';

    /**
     * @var array
     */
    protected $fillable = ['id_raza', 'sexo', 'edad', 'nombre', 'otras_caracteristicas', 'apto_adopcion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'id_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function raza()
    {
        return $this->belongsTo('App\Raza', 'id_raza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotoPerfil()
    {
        return $this->hasMany('App\FotoPerfil', 'id_usuario');
    }

    /**
     * @return string
     * @internal param Mascota $mascota
     */
    public function getFotoPerfil(){
        if($fotoPerfil = $this->fotoPerfil()->where("current", 1)->first())
            return($fotoPerfil);
        return false;
    }
}
