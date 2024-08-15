@extends('layout')

@section('title', 'Servicios')

@section('content')
    <tr>
        @isset($category)
            <div>
                <h1 class="display-4 mb-0">{{ $category->name }}</h1>
                <a href="{{ route('servicios.index') }}" >Regresar a Servicios</a>
            </div>
        @else
            <h1 class="display-4 mb-0">Servicios</h1>
        @endisset
    </tr>
    <tr>
        @auth
            <td colspan="4">
                <a href="{{ route('servicios.create') }}"> Nuevo Servicio</a>
            </td>
        @endauth
    </tr>

    <h2>Listado de Servicios</h2>

    <tr>
        @if ($servicios)
            @foreach ( $servicios as $servicio )
                <td>
                    @if ($servicio->image)
                        <img 
                            src="/storage/{{ $servicio->image }}" 
                            alt="{{ $servicio->titulo }}"
                            width="50" height="50"
                        >
                    @endif
                </td>
                <td colspan="3">
                    <a href="{{ route('servicios.show', $servicio) }}">
                        {{ $servicio->titulo }}
                    </a>
                </td>
                <td colspan="3">
                    @if ($servicio->category_id)
                        <a href="{{ route('categories.show', $servicio->category ) }}" class="badge badge-secondary" >
                            {{ $servicio->category->name }}
                        </a>
                    @endif
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
