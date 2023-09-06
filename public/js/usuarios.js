$(".nuevo-usuario").click(function(){
    modal = cargando("Cargando");
    ajaxModal("modal-usuario-add", 0, "nuevo-usuario");
})
$(document).on("submit","#form-agregar-usuario",function(e) {
    modal = cargando("Agregando Usuario");
    e.preventDefault();
    ajaxRequest("usuarios", 0, "POST", "form-agregar-usuario", "tabla_usuarios","nuevo-usuario");
});

$(document).on("submit","#form-editar-usuario",function(e) {
    console.log("a");
    e.preventDefault();
    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger mr-2"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons
    .fire({
        title: "¿Esta seguro de editar este usuario?",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    })
    .then(function(result) {
        if (result.value) {
            modal = cargando("Editando Usuario");
            ajaxRequest("usuarios", 0, "PUT", "form-editar-usuario", "tabla_usuarios");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "El usuario no fue editado",
                "error"
            );
        }
    });
});

function editar(id){
    modal = cargando("Cargando");
    ajaxModal("modal-usuario-edit", id, "editar_usuario");
}

function ver(id){
    modal = cargando("Cargando");
    ajaxModal("modal-usuario-ver", id, "ver_usuario");
}
function eliminar(id){
    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger mr-2"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons
    .fire({
        title: "¿Esta seguro de eliminar este usuario?",
        text: "No se podrán revertir los cambios!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    })
    .then(function(result) {
        if (result.value) {
            modal = cargando("Eliminado");
            ajaxRequest("usuarios", id, "DELETE", "", "tabla_usuarios");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "El usuario no fue eliminado",
                "error"
            );
        }
    });
    
}

$('#tabla_usuarios').DataTable({
processing: true,
serverSide: true,
responsive: true,
lengthChange: false,
ajax:{
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "usuarioslist",
    type: 'POST',
},
columns:[
    {
    data: 'usuarios_rut',
    name: 'usuarios_rut'

    },
    {
    data: 'usuarios_nombre',
    name: 'usuarios_nombre'

    },
    {
    data: 'usuarios_correo',
    name: 'usuarios_correo'

    },
    {
    data: 'accion',
    name: 'accion',
    className: "inline"

    }
],
drawCallback: function(settings) {
    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
    pagination.toggle(this.api().page.info().pages > 1);
},
language: {
    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
}
});