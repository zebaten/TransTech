@extends('welcome')
@section('titulo')
    <title>Licitación</title>
@endsection
@section('contenido')

<div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9">
    <h2>Licitaciones</h2>
    <div>
        <table id="tabla_licitaciones" class="table w-100">
            <thead>
                <tr>
                <th>Código</th>   
                <th>Nombre</th>
                <th>Valor</th>
                <th>Empresa</th>
                <th>Rut</th>
                <th>Acciones</th>
                
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary nuevo-licitacion">
            Nueva Licitación
            </button>
    </div>
</div>
<div id="modales"></div>

<script src="{{ asset('js/licitaciones.js') }}"></script>
@endsection
