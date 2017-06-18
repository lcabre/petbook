<?php

namespace App\Http\Controllers;

use App\AptoCita;
use Illuminate\Http\Request;
use App\Mascota;

class CitaController extends Controller
{
    public function cita(Request $request){
        $cita = Mascota::find($request->idcita);
        $citada = Mascota::find($request->idcitada);
       // dd([$cita, $citada]);
        $cita->citar($citada);
        return redirect()->back()->with('message', 'Cita enviada, por favor espera su respuesta');
    }

    public function aceptarCita(Request $request){
        $citada = Mascota::find($request->idcitada);
        $cita = Mascota::find($request->idcita);
        $citada->citas()->updateExistingPivot($request->idcita, ["concretado" => 1]);
        $aptoCita = $citada->aptoCitas()->where("concretado",0)->first();
        $aptoCita->concretado = 1;
        $aptoCita->save();
        $nombre = $cita->usuario()->first()->nombre;
        $email = $cita->usuario()->first()->user()->first()->email;
        return redirect()->back()->with('message', 'Has aceptado la cita. Comunicate por mail con '.$nombre.' a la direccion '.$email.' para ultimar detalles.');
    }

    public function setAptoCita(Request $request)
    {
        $apto = AptoCita::where("id_mascota", $request->id)->where("concretado", 0)->first();
        //dd(var_dump($apto), $request->apto_cita);
        if($request->apto_cita == "si"){
            if(!$apto){
                $aptoCita = new AptoCita();
                $aptoCita->id_mascota = $request->id;
                $aptoCita->id_raza = $request->raza;
                $aptoCita->save();
            }else{
                $apto->id_raza = $request->raza;
                $apto->save();
            }
        }else{
            if($apto){
                $apto->concretado = 1;
                $apto->save();
            }
        }
        return redirect()->back();
    }

    public function citaInformada(Request $request){
        $citada = Mascota::find($request->idcitada);
        $cita = Mascota::find($request->idcita);
        $cita->cito()->updateExistingPivot($request->idcitada, ["informado" => 1]);
        //dd($cita->cito()->get());
        $nombre = $citada->usuario()->first()->nombre;
        $email = $citada->usuario()->first()->user()->first()->email;
        return redirect()->back()->with('message', 'Han aceptado tu cita. Comunicate por mail con '.$nombre.' a la direccion '.$email.' para ultimar detalles.');
    }

}
