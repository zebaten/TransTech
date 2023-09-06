@extends('welcome')
@section('titulo')
    <title>Usuarios</title>
@endsection
@section('contenido')

<div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9">
    <h2>Usuarios</h2>
    <div>
        <table id="tabla_usuarios" class="table w-100">
            <thead>
                <tr>
                <th>Rut</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary nuevo-usuario">
            Nuevo Usuario
            </button>
    </div>
</div>
<div id="modales"></div>

<script src="{{ asset('js/usuarios.js') }}"></script>
@endsection