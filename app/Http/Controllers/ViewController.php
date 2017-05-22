<?php

namespace App\Http\Controllers;

use App\Mascota;
use App\Raza;
use App\TipoMascota;
use Auth;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    private $variables = array();
    /**
     * Create a new controller instance.
     *
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWall(){
        $user = Auth::user();
        $variables = array();

        $perfil = $user->getPerfil();
        array_push($variables, "perfil");

        $mascotas = $perfil->mascotas()->get();
        array_push($variables, "mascotas");

        if($fotoPerfil = $perfil->getFotoPerfil())
            array_push($variables, "fotoPerfil");

        return view('wall', compact($variables));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexMascota(){
        $user = Auth::user();
        $variables = array();

        $perfil = $user->getPerfil();
        array_push($variables, "perfil");

        if($fotoPerfil = $perfil->getFotoPerfil())
            array_push($variables, "fotoPerfil");
        if($mascotas = $perfil->getMascotas())
            array_push($variables, "mascotas");

        return view('mascotas', compact($variables));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function agregarMascota(){
        $user = Auth::user();
        $variables = array();

        $perfil = $user->getPerfil();
        if($fotoPerfil = $perfil->getFotoPerfil())
            array_push($variables, "fotoPerfil");

        $razas = Raza::all();
        array_push($variables, "razas");
        $tipos = TipoMascota::all();
        array_push($variables, "tipos");
        return view('agregarMascotas', compact($variables));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexPerfil(){
        $user = Auth::user();
        $variables = array();

        $perfil = $user->getPerfil();
        array_push($variables, "perfil");
        if($fotoPerfil = $perfil->getFotoPerfil())
            array_push($variables, "fotoPerfil");
        return view('perfil', compact($variables));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editDatosPerfil(){
        $user = Auth::user();
        $perfil = $user->usuario()->first();
        return view('editdatos', compact("perfil"));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editMascota($id){
        $user = Auth::user();
        $variables = array();

        $perfil = $user->usuario()->first();
        $mascota = Mascota::find($id);
        array_push($variables, "mascota");

        $tipos = TipoMascota::all();
        array_push($variables, "tipos");
        $razas = Raza::where("id_tipo_mascota",$mascota->getTipoMascota()->id)->get();
        array_push($variables, "razas");


        return view('editmascota', compact($variables));
    }

    public function wallMascota($id){
        $variables = array();

        $mascota = Mascota::find($id);
        array_push($variables, "mascota");

        $posts = $mascota->getPosts();
        array_push($variables, "posts");

        //$mascotasParaSeguir = Mascota::take(3)->get();
        $mascotasParaSeguir = $mascota->getNoSeguidos();
        array_push($variables, "mascotasParaSeguir");

        return view('wallmascota', compact($variables));
    }
}
