<?php

namespace App\Http\Controllers;
use App\Mascota;
use App\Raza;
use App\TipoMascota;
use Auth;
use App\Usuario;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * MascotaController constructor.
     */
    public function __construct(){
        $this->middleware("auth");
    }

    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    /*protected $validationRules=[
        'email' => 'required|email|unique:users'
        'sexo' => 'max:1',
        "fecha_nacimiento" => 'date'
    ];*/

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = Auth::user();
        $variables = array();

        $perfil = $user->getPerfil();
        if($fotoPerfil = $perfil->getFotoPerfil())
            array_push($variables, "fotoPerfil");
        if($mascotas = $perfil->getMascotas())
            array_push($variables, "mascotas");

        return view('mascotas', compact($variables));
    }

    public function agregarMascotaView(){
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

    public function addMascota(Request $request){
        $user = Auth::user();
        $perfil = $user->getPerfil();

        $this->validate($request, [
            'nombre' => 'required|max:100',
            'sexo' => 'required',
            'edad' => 'required',
            'apto_adopcion' => 'required',
            'clase' => 'required',
            'raza' => 'required'
        ]);
        $request->flash();
        $mascota = new Mascota();
        $mascota->nombre = $request->nombre;
        $mascota->sexo = $request->sexo;
        $mascota->edad = $request->edad;
        $mascota->otras_caracteristicas = $request->otras_caracteristicas;
        $mascota->apto_adopcion = ($request->apto_adopcion == "si")?1:0;

        $perfil->mascotas()->save($mascota);

        $raza = Raza::where("id", $request->raza)->first();
        $raza->mascotas()->save($mascota);

    }
}
