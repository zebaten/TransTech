@extends('welcome')
@section('titulo')
    <title>Costos</title>
@endsection
@section('contenido')
    <div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9">
        <h2>Costos viaje codigo: {{ $viaje->id }}</h2>
        <div>
            <table id="tabla_costos" class="table w-100">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Costo</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary nuevo-costo">
                Nuevo Costo
            </button>
            @if (Auth::user()->rol_cod == 1)
                <a href="{{ asset('viaje') }}" class="btn btn-primary nuevo-viaje">
                    Volver
                </a>
            @else
                <a href="{{ asset('misViajes') }}" class="btn btn-primary nuevo-viaje">
                    Volver
                </a>
            @endif
        </div>
    </div>
    <div id="modales"></div>

    <script src="{{ asset('js/Costos.js') }}"></script>
@endsection
