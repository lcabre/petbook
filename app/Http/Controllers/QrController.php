<?php

namespace App\Http\Controllers;

use App\Mascota;
use Illuminate\Http\Request;
use Milon\Barcode\DNS2D;
use Barryvdh\DomPDF\Facade as PDF;

class QrController extends Controller
{
    public function qrMascota($id){
        $variables = array();

        $mascota = Mascota::find($id);
        array_push($variables, "mascota");

        $perfil = $mascota->usuario()->first();
        array_push($variables, "perfil");

        return view('qrmascota', compact($variables));
    }

    public function descargar(Request $request){

        $mascota = Mascota::find($request->id);
        $qr = DNS2D::getBarcodeHTML(route("qrMascota", $mascota->id), "QRCODE", 9,9);
        //dd($qr);
        $titulo = "<h2>Código QR para: ".$mascota->nombre."</h2><br>";
        $pdf = PDF::loadHTML($titulo.$qr."<br>Petbook.com");

        return $pdf->download('QR - '.$mascota->nombre.'.pdf');
    }
}
