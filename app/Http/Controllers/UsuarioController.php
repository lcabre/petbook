<?php

namespace App\Http\Controllers;

use App\Mascota;
use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function pedirAdopcion(Request $request){
        $usuario = Usuario::find($request->idusuario);
        $mascota = Mascota::find($request->idmascota);
        //dd($usuario, $mascota);

        $usuario->adopciones()->attach($mascota);
        return redirect()->back()->with('message', 'Adopcion enviada, por favor espera su respuesta');
    }

    public function aceptarAdopcion(Request $request){
        $usuario = Usuario::find($request->idusuario);
        $mascota = Mascota::find($request->idmascota);
        //dd($usuario, $mascota);
        $mascota->adopciones()->updateExistingPivot($request->idusuario, ["concretado" => 1]);
        $aptoAdopcion = $mascota->aptoAdopcion()->where("concretado",0)->first();
        $aptoAdopcion->concretado = 1;
        $aptoAdopcion->save();

        $mascotasUsuario = $usuario->mascotas()->get();
        foreach ($mascotasUsuario as $mascotaUsuario){
            if($mascotaUsuario->sigo()->find($mascota->id)){
                $mascotaUsuario->sigo()->detach($mascota->id);
            }
        }

        $mascota->usuario()->associate($usuario)->save();

        $nombre = $mascota->usuario()->first()->nombre;
        $email = $mascota->usuario()->first()->user()->first()->email;
        return redirect()->back()->with('message', 'Has aceptado la adopcion, a partir de este momento dejaras de ver a '.$mascota->nombre.' como propia. Comunicate por mail con '.$nombre.' a la direccion '.$email.' para ultimar detalles.');
    }

    public function adopcionInformada(Request $request){
        $usuario = Usuario::find($request->idusuario);
        $mascota = Mascota::find($request->idmascota);

        $usuario->adopciones()->updateExistingPivot($request->idmascota, ["informado" => 1]);
        //dd($cita->cito()->get());
        $nombre = $mascota->usuario()->first()->nombre;
        $email = $mascota->usuario()->first()->user()->first()->email;
        return redirect()->back()->with('message', 'Han aceptado tu adopcion, a partir de este momento comenzaras a ver a '.$mascota->nombre.' como propia. Comunicate por mail con '.$nombre.' a la direccion '.$email.' para ultimar detalles.');
    }
}
