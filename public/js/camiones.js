$(".nuevo-camion").click(function(){
    modal = cargando("Cargando");
    ajaxModal("modal-camion-add", 0, "nuevo-camion");
})
$(document).on("submit","#form-agregar-camion",function(e) {
    e.preventDefault();
    modal = cargando("Agregando Camión");
    ajaxRequest("camiones", 0, "POST", "form-agregar-camion", "tabla_camiones","nuevo-camion");
});

$(document).on("submit","#form-editar-camion",function(e) {
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
        title: "¿Esta seguro de editar este camión?",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    })
    .then(function(result) {
        if (result.value) {
            modal = cargando("Editando Camión");
            ajaxRequest("camiones", 0, "PUT", "form-editar-camion", "tabla_camiones");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "El camión no fue editado",
                "error"
            );
        }
    });
});

function editar(id){
    modal = cargando("Cargando");
    ajaxModal("modal-camion-edit", id, "editar_camion");
}

function ver(id){
    modal = cargando("Cargando");
    ajaxModal("modal-camion-ver", id, "ver_camion");
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
        title: "¿Esta seguro de eliminar este camión?",
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
            ajaxRequest("camiones", id, "DELETE", "", "tabla_camiones");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "El camión no fue eliminado",
                "error"
            );
        }
    });
    
}

$('#tabla_camiones').DataTable({
processing: true,
serverSide: true,
responsive: true,
lengthChange: false,
ajax:{
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "camioneslist",
    type: 'POST',
},
columns:[
    {
    data: 'patente',
    name: 'pantente'

    },
    {
    data: 'marca',
    name: 'marca'

    },
    {
    data: 'modelo',
    name: 'modelo'

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