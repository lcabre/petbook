<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_usuario
 * @property string $nombre
 * @property 0,1 $current
 * @property string $updated_at
 * @property string $created_at
 * @property Usuario $usuario
 */
class FotoPerfil extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'foto_perfil';

    /**
     * @var array
     */
    protected $fillable = ['id_usuario', 'nombre', 'current','updated_at', 'created_at'];

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
    public function mascota()
    {
        return $this->belongsTo('App\Mascota', 'id_mascota');
    }

    /**
     * @return string
     */
    public function getUrl(){
        return("/storage/".$this->nombre);
    }
}
