<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


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
 * @property FotoPerfil[] $fotoPerfil
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
    protected $fillable = ['id_user', 'nombre', 'domicilio', 'telefono', 'geoposicion', 'sexo', 'fecha_nacimiento'];
    protected $dates = ['fecha_nacimiento'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function adopciones()
    {
        return $this->belongsToMany('App\Mascota', 'adopcion', 'id_usuario', 'id_mascota')->withTimestamps();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotoPerfil()
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
     * Todos los posts de las mascotas de este usuario
     */
    public function mascotasPosts()
    {
        return $this->hasManyThrough('App\Post', 'App\Mascota', "id_usuario", "id_mascota");
    }

    /**
     * @return string
     */
    public function getFotoPerfil(){
        if($fotoPerfil = $this->fotoPerfil()->where("current", 1)->first())
            return($fotoPerfil);
        return false;
    }

    /**
     * @param Mascota $mascota
     */
    public function addMascotas(Mascota $mascota){
        $this->mascotas()->save($mascota);
    }

    /**
     * @return Mascota
     */
    public function getMascotas(){
        return $this->mascotas()->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getMascotaById($id){
        return $this->mascotas()->where("id", $id)->first();
    }

    /**
     * @return Post
     */
    public function getMascotasPosts(){
        return $this->mascotasPosts()->orderBy("created_at","desc")->get();
    }

    public function getMascotaActiva(){
        dd($request->session()->get('idMascotaActiva'));
        return Mascota::find($request->session()->get('idMascotaActiva'));
    }

    public function hasThisMascotaId($id){
        return $this->mascotas()->find($id);
    }

    public function getAptoAdopcion(){
        $result = aptoAdopcion::whereNotIn("id_mascota",
            function ($query) {//no este entre los que les mande adopcion
                $query->select(DB::raw("id_mascota"))
                    ->from('adopcion')
                    ->where("id_usuario","=", $this->id)
                    ->where("concretado", 0);
            }
        )->whereNotIn("id_mascota",
            function ($query) {//no sea mi mascota
                $query->select(DB::raw("id"))
                    ->from('mascota')
                    ->where("id_usuario","=", $this->id);
            }
        )
        ->where("concretado", 0)
        ->orderBy("updated_at", "desc")
        ->get();
        //dd($result);
        if ($result->isEmpty())
            return false;
        else
            return $result;
    }

    public function getNotificaciones($tipo){
        if($tipo=="nuevaadopcion"){
            $lista = $this->adopciones()->wherePivot("concretado", 0)->get();
            if ($lista->isEmpty())
                return false;
            else
                return $lista;
        }
        if($tipo=="adopcionconcretada"){
            $lista = $this->adopciones()->wherePivot("concretado", 1)->wherePivot("informado",0)->get();
            if ($lista->isEmpty())
                return false;
            else
                return $lista;
        }
    }
}
