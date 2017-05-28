<?php

namespace App\Http\Controllers;
use App\FotoPerfil;
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        $raza = Raza::find($request->raza)->first();
        $raza->mascotas()->save($mascota);

        return redirect()->route('mascotas');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editMascota(Request $request){
        $user = Auth::user();

        $this->validate($request, [
            'nombre' => 'required|max:100',
            'sexo' => 'required',
            'edad' => 'required',
            'apto_adopcion' => 'required',
            'clase' => 'required',
            'raza' => 'required'
        ]);

        $request->flash();

        $mascota = Mascota::find($request->id);

        $mascota->nombre = $request->nombre;
        $mascota->sexo = $request->sexo;
        $mascota->edad = $request->edad;
        $mascota->otras_caracteristicas = $request->otras_caracteristicas;
        $mascota->apto_adopcion = ($request->apto_adopcion == "si")?1:0;
        $mascota->save();

        if($request->raza != $mascota->getRaza()->id){
            $raza = Raza::find($request->raza);
            $raza->mascotas()->save($mascota);
        }

        return redirect()->back()->with('message', 'Los cambios se guardaron con exito.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeMascota(Request $request){
        Mascota::destroy($request->id);
        return redirect()->route('mascotas');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function uploadPerfilImage(Request $request){
        $user = Auth::user();
        $mascota = Mascota::find($request->id);
        //dd($request->id);
        //Storage::delete('file.jpg');
        $imgPerfilAnterior = $mascota->fotoPerfil()->where("current",1)->first();
        if($imgPerfilAnterior){
            $imgPerfilAnterior->current = 0;
            // Storage::delete($imgPerfilAnterior->nombre);//la borro
            $imgPerfilAnterior->save();
        }

        $path = $request->perfil_image->store('perfil_images');
        $foto = new FotoPerfil();
        $foto->nombre = $path;
        $mascota->fotoPerfil()->save($foto);
        return "/storage/".$path;
    }

    public function seguir(Request $request){
        $mascotaSeguidora = Mascota::find($request->id_sigue);
        $mascotaSeguida = Mascota::find($request->id_seguida);
        //dd([$mascotaSeguida, $mascotaSeguidora]);
        $mascotaSeguidora->seguir($mascotaSeguida);
        return redirect()->back();
    }
}
