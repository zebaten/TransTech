@extends('welcome')
@section('titulo')
    <title>Cargas</title>
@endsection
@section('contenido')

<div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9">
    <h2>Cargas viaje codigo {{ $viaje->id }}</h2>
    <div>
        <table id="tabla_cargas" class="table w-100">
                <thead>
                    <tr>
                    <th>Nombre</th>
                    <th>Peso</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary nuevo-carga">
                Nueva Carga
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
<script src="{{ asset('js/cargas.js') }}"></script>
@endsection
