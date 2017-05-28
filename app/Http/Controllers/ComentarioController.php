<?php

namespace App\Http\Controllers;

use App\Mascota;
use App\Post;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    /**
     * ComentarioController constructor.
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function newComentario(Request $request){
        $mascota = Mascota::find($request->idmascota);
        $post = Post::find($request->idpost);
       // dd($mascota, $post);

        $mascota->comentarios()->attach($post,["comentario" => $request->comentario]);

        return redirect()->back();
    }


}
