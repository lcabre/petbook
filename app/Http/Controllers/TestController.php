<?php

namespace App\Http\Controllers;

use App\User;
use App\Usuario;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use App\TipoMascota;
use App\Raza;

class TestController extends Controller
{
    public function index(){
       /* $tipoMascota = TipoMascota::All()->first();
        $raza = new Raza;
        $raza->nombre = "Pequines";
        //$raza->save();
        //print_r($tipoMascota->razas()->save($raza));
         dd($tipoMascota->razas()->get());*/

       $cuenta = User::where("email","leocab16@gmail.com")->firstOrFail();
       //dd($cuenta);
       $usuario = new Usuario();
       $usuario->domicilio = "santamarina 1848";
       $usuario->nombre ="Leo";
      // dd($usuario);
       $cuenta->usuario()->save($usuario);
    }
}
