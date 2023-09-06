<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Prueba de Concepto</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Prueba de Concepto</h2>
        <form id="formulario">
            <div class="form-group">
              <label for="exampleInputEmail1">Correo</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="correo" aria-describedby="emailHelp" placeholder="Ingresar Correo">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Nombre</label>
              <input type="text" class="form-control" id="exampleInputPassword1" name="nombre" placeholder="Ingresar Nombre">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </form>
          <table id="tabla" class="table">
            <thead>
                <tr>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th>Correo</th>
                <th>Nombre</th>
                <th>Eliminar</th>
                </tr>
            </tfoot>
          </table>
    </div>
</body>
</html>
<script>
$("#formulario").submit(function(e){
    e.preventDefault();
    var formulario = document.getElementById("formulario");
    var formdata = new FormData(formulario);
    formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'prueba',
        processData: false,
        contentType: false,
        type: 'POST',
        data : formdata,
        success: function(data){
            alert("Correcto");
            $("#tabla").DataTable().ajax.reload();
        },
        error: function(){
            alert("Error");
        }
    })
})

$('#tabla').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengthChange: false,
    ajax:{
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "pruebalist",
        type: 'POST',
    },
    columns:[
        {
        data: 'correo',
        name: 'correo'

        },
        {
        data: 'nombre',
        name: 'nombre'

        },
        {
        data: 'accion',
        name: 'accion'

        }
    ],
    drawCallback: function(settings) {
        var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
        pagination.toggle(this.api().page.info().pages > 1);
    }
});

function eliminar(id){
    var formdata = new FormData();
    formdata.append("id", id);
    formdata.append("_method", "DELETE");
    formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'prueba',
        processData: false,
        contentType: false,
        type: 'POST',
        data : formdata,
        success: function(data){
            alert("Correcto");
            $("#tabla").DataTable().ajax.reload();
        },
        error: function(){
            alert("Error");
        }
    })
}
</script>