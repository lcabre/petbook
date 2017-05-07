<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Usuario;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        $perfil = $user->usuario()->first();
        if(!$perfil){
            $perfil = $user->addPerfil($user);
        }
        return view('perfil', compact("perfil"));
    }

    public function editDatos(){
        $user = Auth::user();
        $perfil = $user->usuario()->first();
        return view('editdatos', compact("perfil"));
    }

    /**
     * @param Request $request
     * @return mixed|null
     */
    public function editData(Request $request){
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
