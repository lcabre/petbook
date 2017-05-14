<?php

namespace App\Http\Controllers;

use App\Mascota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Usuario;
use App\FotoPerfil;
use Illuminate\Support\Facades\Auth;
use Storage;

class PerfilController extends Controller
{

    function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * @param Request $request
     * @return string
     */
    public function uploadPerfilImage(Request $request){
        $user = Auth::user();
        $perfil = $user->usuario()->first();

        //Storage::delete('file.jpg');
        $imgPerfilAnterior = $perfil->fotoPerfil()->where("current",1)->first();
        if($imgPerfilAnterior){
           $imgPerfilAnterior->current = 0;
          // Storage::delete($imgPerfilAnterior->nombre);//la borro
           $imgPerfilAnterior->save();
        }

        $path = $request->perfil_image->store('perfil_images');
        $foto = new FotoPerfil();
        $foto->nombre = $path;
        $perfil->fotoPerfil()->save($foto);
        return "/storage/".$path;
    }

    /**
     * @param Request $request
     * @return mixed|null
     */
    public function editData(Request $request){
        $this->validate($request, [
            'email' => 'email|unique:User',
            'sexo' => 'max:1',
            'fecha_nacimiento' => 'date',
        ]);

        $user = Auth::user();
        $perfil = $user->usuario()->first();
        (isset($request["email"]))?$email = (string)$request["email"]:null;
        (isset($request["nombre"]))? $nombre = (string)$request["nombre"]:null;
        (isset($request["domicilio"]))?$domicilio =  (string)$request["domicilio"]:null;
        (isset($request["telefono"]))?$telefono = (string)$request["telefono"]:null;
        (isset($request["sexo"]))?$sexo = (string)$request["sexo"]:null;
        (isset($request["fecha_nacimiento"]))?$fecha_nacimiento = (string)$request["fecha_nacimiento"]:null;
        $dato = null;
        if(isset($email)){
            $user->email = $email;
            $dato = $email;
            $user->save();
        }
        if(isset($nombre)){
            $perfil->nombre = $nombre;
            $dato = $nombre;
        }
        if(isset($domicilio)){
            $perfil->domicilio = $domicilio;
            $dato = $domicilio;
        }
        if(isset($telefono)){
            $perfil->telefono = $telefono;
            $dato = $telefono;
        }
        if(isset($sexo)){
            $perfil->sexo = $sexo;
            $dato = $sexo;
        }
        if(isset($fecha_nacimiento)){
            if($fecha_nacimiento == "")
                $perfil->fecha_nacimiento = NULL;
            else
                $perfil->fecha_nacimiento = Carbon::createFromFormat('d-m-Y', $fecha_nacimiento);
            $dato = $fecha_nacimiento;
        }
        $perfil->save();

        return $dato;
    }
}
