<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() === null )
            return response()->view('que hacemos?... no no no Carlin Calvo', $data, 401);

        $usuario = $request->user()->getPerfil();
        $mascota = $usuario->getMascotas()->find($request->id);

        if(!$mascota) {
            //return response("No no no... amiguito loco", 401);
            return response()->view('error', ["error" => "que hacemos?...  no no no Carlin Calvo"], 401);
        }
        return $next($request);
    }
}
