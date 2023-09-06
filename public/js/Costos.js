$(".nuevo-costo").click(function(){
    modal = cargando("Cargando");
    ajaxModal("modal-costo-add", 0, "nuevo-costo");
})
$(document).on("submit","#form-agregar-costo",function(e) {
    e.preventDefault();
    modal = cargando("Agregando costo");
    ajaxRequest("costos", 0, "POST", "form-agregar-costo", "tabla_costos","nuevo-costo");
});

$(document).on("submit","#form-editar-costo",function(e) {
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
        title: "¿Esta seguro de editar este costo?",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    })
    .then(function(result) {
        if (result.value) {
            modal = cargando("Editando Costos");
            ajaxRequest("costos", 0, "PUT", "form-editar-costo", "tabla_costos");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "El costo no fue editado",
                "error"
            );
        }
    });
});

function editar(id){
    modal = cargando("Cargando");
    ajaxModal("modal-costo-edit", id, "costo");
}

function ver(id){
    modal = cargando("Cargando");
    ajaxModal("modal-costo-ver", id, "ver_costo");
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
        title: "¿Esta seguro de eliminar este costo?",
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
            ajaxRequest("costos", id, "DELETE", "", "tabla_costos");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "El costo no fue eliminado",
                "error"
            );
        }
    });
    
}

$('#tabla_costos').DataTable({
processing: true,
serverSide: true,
responsive: true,
lengthChange: false,
ajax:{
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "costoslist",
    type: 'POST',
},
columns:[
    {
    data: 'costos_nombre',
    name: 'costos_nombre'

    },
    {
    data: 'costos_costo',
    name: 'costos_costo'

    },
    {
    data: 'costos_cantidad',
    name: 'costos_cantidad'

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