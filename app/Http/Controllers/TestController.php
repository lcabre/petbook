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
    public function test(){
       /* $tipoMascota = TipoMascota::All()->first();
        $raza = new Raza;
        $raza->nombre = "Pequines";
        //$raza->save();
        //print_r($tipoMascota->razas()->save($raza));
         dd($tipoMascota->razas()->get());*/

       $cuenta = User::where("email","leocab16@gmail.com")->firstOrFail();
       //dd($user);
       $usuario = Usuario::create([
           "nombre" => "Leo",
            "domicilio" => "santamarina 1848"
        ]);
       $cuenta->usuario()->save($usuario);
       dd($cuenta);

    }
}
