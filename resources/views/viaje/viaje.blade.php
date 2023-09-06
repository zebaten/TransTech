@extends('welcome')
@section('titulo')
    <title>Viajes</title>
@endsection
@section('contenido')

    <div class="container mt-5 bg-light p-5 rounded" style="opacity: 0.9">
        <h2>Viajes</h2>
        <div>
            <table id="tabla_viaje" class="table">
                <thead>
                    <tr>
                        <th>Código de viaje</th>
                        <th>Rut Camionero</th>
                        <th>Lugar inicio</th>
                        <th>Lugar destino</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary nuevo-viaje">
                Nuevo viaje
            </button>
        </div>
    </div>
    <div id="modales"></div>

    <script src="{{ asset('js/viaje.js') }}"></script>
@endsection
