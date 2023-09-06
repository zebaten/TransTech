$(".nuevo-licitacion").click(function(){
    modal = cargando("Cargando");
    ajaxModal("modal-licitacion-add", 0, "nuevo-licitacion");
})
$(document).on("submit","#form-agregar-licitacion",function(e) {
    modal = cargando("Agregando Licitacion");
    e.preventDefault();
    ajaxRequest("licitaciones", 0, "POST", "form-agregar-licitacion", "tabla_licitaciones","nuevo-licitacion");
});

$(document).on("submit","#form-editar-licitacion",function(e) {
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
        title: "¿Esta seguro de editar esta licitación?",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Si, editar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    })
    .then(function(result) {
        if (result.value) {
            modal = cargando("Editando Licitación");
            ajaxRequest("licitaciones", 0, "PUT", "form-editar-licitacion", "tabla_licitaciones");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La licitación no fue editada",
                "error"
            );
        }
    });
});

function editar(id){
    modal = cargando("Cargando");
    ajaxModal("modal-licitacion-edit", id, "editar_licitacion");
}

function ver(id){
    modal = cargando("Cargando");
    ajaxModal("modal-licitacion-ver", id, "ver_licitacion");
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
        title: "¿Esta seguro de eliminar esta licitación?",
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
            ajaxRequest("licitaciones", id, "DELETE", "", "tabla_licitaciones");
        } 
        else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                "Cancelado",
                "La licitación no fue eliminada",
                "error"
            );
        }
    });
    
}

$('#tabla_licitaciones').DataTable({
processing: true,
serverSide: true,
responsive: true,
lengthChange: false,
ajax:{
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "licitacioneslist",
    type: 'POST',
},
columns:[
    {
    data: 'id',
    name: 'Codigo de licitacion'
    
    },
    {
    data: 'lic_nombre',
    name: 'lic_nombre'

    },
    {
    data: 'lic_valor',
    name: 'lic_valor'

    },
    {
    data: 'lic_empresa',
    name: 'lic_empresa'

    },
    {
    data: 'lic_rut',
    name: 'lic_rut'

    },
    {
        data: "accion",
        name: "accion",
        className: "inline"
    }
],
drawCallback: function(settings) {
    var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
    pagination.toggle(this.api().page.info().pages > 1);
}
,
language: {
    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
}
});