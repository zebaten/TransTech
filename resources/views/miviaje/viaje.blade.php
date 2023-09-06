@extends('welcome')
@section('titulo')
    <title>Mis Viajes</title>
@endsection
@section('contenido')

<div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9">
    <h2>Mis Viajes</h2>
    <div>
        <table id="tabla_viajes" class="table w-100">
            <thead>
                <tr>
                    <th>Origen</th>
                    <th>Fecha Salida</th>
                    <th>Destino</th>
                    <th>Fecha llegada</th> 
                    <th>Costos</th>
                    <th>Cargas</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div id="modales"></div>

<script src="{{ asset('js/miviaje.js') }}"></script>
@endsection