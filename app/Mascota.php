<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function seguidores()
    {
        return $this->belongsToMany('App\Mascota', 'sigue', 'id_mascota2', 'id_mascota')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sigo()
    {
        return $this->belongsToMany('App\Mascota', 'sigue', 'id_mascota', 'id_mascota2')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany('App\Post', 'likes', 'id_mascota', 'id_post')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comentarios()
    {
        return $this->belongsToMany('App\Post', 'comentario', 'id_mascota', 'id_post')->withTimestamps()->withPivot('id','comentario');
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
        return $this->hasMany('App\FotoPerfil', 'id_mascota');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post', 'id_mascota');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aptoCitas()
    {
        return $this->hasMany('App\AptoCita', 'id_mascota');
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

    /**
     * @return mixed
     */
    public function getRaza(){
        return $this->raza()->first();
    }

    /**
     * @return mixed
     */
    public function getTipoMascota(){
        $raza = $this->raza()->first();
        $tipo = $raza->getTipo();
        return $tipo;
    }

    public function getPosts(){
        return $this->posts()->orderBy("created_at", "desc")->get();
    }

    /**
     * @return false|Mascota
     */
    public function getNoPropias(){
        $result = Mascota::where("id_usuario","!=", $this->usuario()->first()->id)
            ->orderBy("updated_at", "desc")
            ->limit(3)
            ->get();
        return $result;
    }

    /**
     * @param int $limit
     * @return Mascota|false
     */
    public function getNoSeguidos($limit = null){
        $result = Mascota::where("id_usuario","!=", $this->usuario()->first()->id)
            ->whereNotIn("id",
                function ($query) {
                    $query->select(DB::raw("id_mascota2"))
                        ->from('sigue')
                        ->where("id_mascota","=", $this->id);
                }
            )
            ->orderBy("updated_at", "desc");
        if($limit)
           $result = $result->limit($limit);

        return $result->get();
    }

    /**
     * @param Mascota $mascota
     */
    public function seguir(Mascota $mascota){
        $this->sigo()->attach($mascota);
    }
}
