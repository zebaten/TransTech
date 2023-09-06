$(".nuevo-carga").click(function(){
    modal = cargando("Cargando");
    ajaxModal("modal-carga-add", 0, "nuevo-carga");
})
$(document).on("click",".agregar-carga",function() {
    modal = cargando("Agregando Carga");
    ajaxRequest("cargas", 0, "POST", "form-carga", "tabla_cargas","nuevo-carga");
});

$(document).on("click",".editar-carga",function() {
    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger mr-2"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons
    .fire({
        title: "¿Esta seguro de editar esta carga?",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    })
    .then(function(result) {
        if (result.value) {
            modal = cargando("Editando Carga");
            ajaxRequest("cargas", 0, "PUT", "form-carga", "tabla_cargas");
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La carga no fue editada.",
                "error"
            );
        }
    });
});

function editar(id){
    modal = cargando("Cargando");
    ajaxModal("modal-carga-edit", id, "editar_carga");
}

function ver(id){
    modal = cargando("Cargando");
    ajaxModal("modal-carga-ver", id, "ver_carga");
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
        title: "¿Esta seguro de eliminar esta carga?",
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
            ajaxRequest("cargas", id, "DELETE", "", "tabla_cargas");
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La carga no fue eliminada",
                "error"
            );
        }
    });

}

$('#tabla_cargas').DataTable({
processing: true,
serverSide: true,
responsive: true,
lengthChange: false,
ajax:{
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "cargaslist",
    type: 'POST',
},
columns:[
    {
    data: 'nombre',
    name: 'nombre'

    },
    {
    data: 'peso',
    name: 'peso'

    },
    {
    data: 'tipo',
    name: 'tipo'

    },
    {
    data: 'cantidad',
    name: 'cantidad'

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
    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
}
});
