<?php

namespace App\Http\Controllers;

use App\Mascota;
use App\Raza;
use App\TipoMascota;
use App\Post;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Milon\Barcode\DNS2D;

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
    public function indexWall(Request $request){
        $user = Auth::user();
        $variables = array();

        $perfil = $user->getPerfil();
        array_push($variables, "perfil");

        $mascotas = $perfil->mascotas()->get();
        array_push($variables, "mascotas");

        if($fotoPerfil = $perfil->getFotoPerfil())
            array_push($variables, "fotoPerfil");

        if($mascotas->count())
            $request->session()->put('idMascotaActiva', $perfil->mascotas()->first()->id);

        $postDeMascotas = $perfil->getMascotasPosts();
        array_push($variables, "postDeMascotas");
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
        array_push($variables, "perfil");

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

        $qr = DNS2D::getBarcodeSVG(route("qrMascota", $mascota->id), "QRCODE", 9,9);

        array_push($variables, "qr");

        $tipos = TipoMascota::all();
        array_push($variables, "tipos");

        $razas = Raza::where("id_tipo_mascota",$mascota->getTipoMascota()->id)->get();
        array_push($variables, "razas");

        return view('editmascota', compact($variables));
    }

    public function wallMascota($id, Request $request){
        $user = Auth::user();
        $variables = array();
        $request->session()->put('idMascotaActiva', $id);

        $perfil = $user->usuario()->first();
        array_push($variables, "perfil");

        $mascota = Mascota::find($id);
        array_push($variables, "mascota");

        $misPosts = $mascota->getPosts();
        $misSeguidosPosts = $mascota->getPostsDeMascotasSeguidas();
        $posts =  $misPosts->merge($misSeguidosPosts)->sortByDesc('updated_at');
        array_push($variables, "posts");

        $mascotasParaSeguir = $mascota->getNoSeguidos(3);
        array_push($variables, "mascotasParaSeguir");

        return view('wallmascota', compact($variables));
    }

    public function seguidos($id){
        $variables = array();

        $mascota = Mascota::find($id);
        array_push($variables, "mascota");

        $mascotasParaSeguir = $mascota->getNoSeguidos(3);
        array_push($variables, "mascotasParaSeguir");

        $listaAmigos = $mascota->sigo()->get();
        array_push($variables, "listaAmigos");

        return view('seguidos', compact($variables));
    }

    public function aQuienSeguir($id){
        $variables = array();
        //dd($id);
        $mascota = Mascota::find($id);
        array_push($variables, "mascota");

        $listaNoSeguidas = $mascota->getNoSeguidos();
        array_push($variables, "listaNoSeguidas");

        return view('aquienseguir', compact($variables));
    }

    public function wallSeguido($id){
        $variables = array();

        $mascota = Mascota::find($id);
        array_push($variables, "mascota");

        $miMascota = Mascota::find(Session::get('idMascotaActiva'));
        array_push($variables, "miMascota");

        $miPerfil = Mascota::find(Session::get('idMascotaActiva'))->usuario()->first();
        array_push($variables, "miPerfil");

        $posts = $mascota->getPosts();
        array_push($variables, "posts");

        $mascotasParaSeguir = $miMascota->getNoSeguidos(3);
        array_push($variables, "mascotasParaSeguir");

        //dd($mascota, $miMascota, $posts, $miPerfil, $mascotasParaSeguir);
        return view('wallseguido', compact($variables));
    }
}
