$(".nuevo-viaje").click(function() {
    modal = cargando("Cargando");
    ajaxModal("modal-viaje-add", 0, "nuevo-viaje");
});
$(document).on("submit", "#form-agregar-viaje", function(e) {
    e.preventDefault();
    modal = cargando("Agregando Viaje");
    ajaxRequest(
        "viaje",
        0,
        "POST",
        "form-agregar-viaje",
        "tabla_viaje",
        "nuevo-viaje"
    );
});

$(document).on("submit", "#form-editar-viaje", function(e) {
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
            title: "¿Esta seguro de editar este viaje?",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "¡Sí, editar!",
            cancelButtonText: "¡No, cancelar!",
            reverseButtons: true
        })
        .then(function(result) {
            if (result.value) {
                modal = cargando("Editando viaje");
                ajaxRequest(
                    "viaje",
                    0,
                    "PUT",
                    "form-editar-viaje",
                    "tabla_viaje"
                );
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    "Cancelado",
                    "El viaje no fue editado",
                    "error"
                );
            }
        });
});

function editar(id) {
    modal = cargando("Cargando");
    ajaxModal("modal-viaje-edit", id, "editar_viaje");
}

function ver(id) {
    modal = cargando("Cargando");
    ajaxModal("modal-viaje-ver", id, "ver_viaje");
}
function eliminar(id) {
    var swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger mr-2"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons
        .fire({
            title: "¿Esta seguro de eliminar este viaje?",
            text: "¡No se podrán revertir los cambios!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "¡Sí, eliminar!",
            cancelButtonText: "¡No, cancelar!",
            reverseButtons: true
        })
        .then(function(result) {
            if (result.value) {
                modal = cargando("Eliminado");
                ajaxRequest("viaje", id, "DELETE", "", "tabla_viaje");
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    "Cancelado",
                    "El viaje no fue eliminado",
                    "error"
                );
            }
        });
}

$("#tabla_viaje").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengthChange: false,
    ajax: {
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: "viajelist",
        type: "POST"
    },
    columns: [
        {
            data: "id",
            name: "Codigo de viaje"
        },
        {
            data: "usuarios_rut",
            name: "Rut usuario"
        },
        {
            data: "viaje_lugar_inicio",
            name: "Lugar de inicio"
        },
        {
            data: "viaje_destino",
            name: "Lugar de destino"
        },
        {
            data: "viaje_inicio",
            name: "Fecha de inicio"
        },
        {
            data: "viaje_fecha",
            name: "Fecha de viaje"
        },
        {
            data: "accion",
            name: "accion",
            className: "inline"
        }
    ],
    drawCallback: function(settings) {
        var pagination = $(this)
            .closest(".dataTables_wrapper")
            .find(".dataTables_paginate");
        pagination.toggle(this.api().page.info().pages > 1);
    },
    language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    }
});
