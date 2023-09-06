@extends('welcome')
@section('titulo')
    <title>Camiones</title>
@endsection
@section('contenido')

<div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9">
    <h2>Camiones</h2>
    <div>
        <table id="tabla_camiones" class="table w-100">
            <thead>
                <tr>
                <th>Patente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary nuevo-camion">
            Nuevo Camión
            </button>
    </div>
</div>
<div id="modales"></div>

<script src="{{ asset('js/camiones.js') }}"></script>
@endsection
