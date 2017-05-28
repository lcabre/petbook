<?php

namespace App\Http\Controllers;

use App\Foto;
use App\Mascota;
use App\Post;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function newPost(Request $request){
        //dd($request);
        $mascota = Mascota::find($request->id);
        $post = new Post();
        $post->descripcion = $request->post_mensaje;
        $mascota->posts()->save($post);
        if(isset($request->post_image)){
            $path = $request->post_image->store('post_images');
            $foto = new Foto();
            $foto->nombre = $path;
            $foto->save();
            $post->fotos()->attach($foto->id);
        }

        return redirect()->back();
    }

    public function meGusta(Request $request){
        $mascota = Mascota::find($request->idmascota);
        $post = Post::find($request->idpost);

        $mascota->likes()->attach($post);

        return redirect()->back();
    }
}
