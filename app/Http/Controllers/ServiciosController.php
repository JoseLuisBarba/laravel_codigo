<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    //
    public function servicios(){
        $servicios = [
            ['titulo' => 'Servicio 01'],
            ['titulo' => 'Servicio 02'],
            ['titulo' => 'Servicio 03'],
            ['titulo' => 'Servicio 04'],
            ['titulo' => 'Servicio 05'],
        ];
        return view('servicios', compact('servicios'));
    }
}
