@extends('welcome')
@section('titulo')
    <title>Usuarios</title>
@endsection
@section('contenido')

<div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9" id="perfil">
    @include('perfil.ver-perfil')
</div>
<div id="modales"></div>

<script src="{{ asset('js/perfil.js') }}"></script>
@endsection