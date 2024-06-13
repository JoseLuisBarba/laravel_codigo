@extends('layout')

@section('title', 'Crear Servicio')

@section('content')
    <table cellpadding="3" cellspaceing="5">
        <tr>
            <th colspan="4">Crear nuevo servicio</th>
        </tr>
        <form action="{{ route('servicios.store') }}" method="post">
            @csrf
            <tr>
                <th>Titulo</th>
                <td><input type="text" name="titulo"></td>
            </tr>
            <tr>
                <th>Descripcion</th>
                <td><input type="text" name="descripcion"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><button>Guardar</button></td>
            </tr>
        </form>
    </table>
@endsection

