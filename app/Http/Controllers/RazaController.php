<?php

namespace App\Http\Controllers;

use App\Raza;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    public function getById($id){
        return Raza::where("id", $id)->get();
    }

    public function getByTipo($idTipo){
        return Raza::where("id_tipo_mascota", $idTipo)->get();
    }
}
