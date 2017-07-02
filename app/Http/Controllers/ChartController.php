<?php

namespace App\Http\Controllers;

use App\Mascota;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function datosChart(Request $request){
        $miMascota = Mascota::find($request->id);
        $mascotas = Mascota::all();
        $coleccion = new Collection();
        foreach($mascotas as $mascota) {
            $array = array();
            $array["id_mascota"] = $mascota->id;
            $array["nombre"] = $mascota->nombre;
            $Likes = DB::table("likes as l")->join("post as p", "l.id_post", "=", "p.id")->where("p.id_mascota", $mascota->id)->count();
            $eguidores = DB::table("sigue")->where("id_mascota2", $mascota->id)->count();
            $array["total"] = $Likes + $eguidores;
            $coleccion->add($array);
        }

        $misLikes = DB::table("likes as l")->join("post as p", "l.id_post", "=", "p.id")->where("p.id_mascota", $miMascota->id)->count();
        $miseguidores = DB::table("sigue")->where("id_mascota2", $miMascota->id)->count();
        $miTotal = $misLikes + $miseguidores;

        $coleccion = $coleccion->sortByDesc("total")->values();

        /*$pos = $coleccion->search(function ($item, $key) use ($miMascota) {
            return $item["id_mascota"] == $miMascota->id;
        });*/

        $coleccion = $coleccion->forPage(1,5);

        if(!$coleccion->contains('id_mascota', $miMascota->id))
            $coleccion->add(["id_mascota"=>$request->id, "nombre"=>$miMascota->nombre, "total" => $miTotal, "pos"=>$pos]);

        //dd($coleccion, $miTotal, $miMascota );
        return $coleccion;
    }

    private function cmp($a, $b){
        if(strrev($a) == strrev($b)){
            return 1;
        }
        return (strrev($a) < strrev($b)) ? -1 : 1;
    }
}
