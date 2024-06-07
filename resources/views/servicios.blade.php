@extends('layout')

@section('title', 'Servicios')

@section('content')
    <h2>Servicios</h2>

    <tr>
        @if ($servicios)
            @foreach ( $servicios as $servicio )
                <td>
                    <a href="{{ route('servicios.show', $servicio) }}">
                        {{ $servicio->titulo }}
                    </a>
                </td>
            @endforeach
        @else
            <td colspan="4">No existe ningún servicio que mostrar.</td>
        @endif

    </tr>
    <tr>
        <td colspan="4">{{ $servicios->links()}}.</td>
    </tr>
@endsection
