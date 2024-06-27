<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\facades\Mail;
use App\mail\MensajeRecibido;


class ContactoController extends Controller
{

    public function store()
    {
        //
        $mensaje = request()->validate([
            'nombre' => 'required',
            'email' => 'required',
            'asunto' => 'required',
            'mensaje' => 'required'
        ],[
            'nombre.required' => 'Ingresa tu nombre',
            'email.required' => 'Ingresa tu correo',
            'asunto.required' => 'Ingresa un asunto',
            'mensaje.required' => 'Ingresa el mensaje'
        ]);

        Mail::to('barba.farro.jose.luis@gmail.com')->send(new MensajeRecibido($mensaje));
        //return new MensajeRecibido($mensaje);
        return 'Mensaje Enviado';
    }

}
