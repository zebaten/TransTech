
function ver(id) {
    modal = cargando("Cargando");
    ajaxModal("modal-misViajes-ver", id, "ver_viaje");
}


$("#tabla_viajes").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengthChange: false,
    ajax: {
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: "misViajeslist",
        type: "POST"
    },
    columns: [
        {
            data: "viaje_lugar_inicio",
            name: "Lugar de inicio"
        },
        {
            data: "viaje_inicio",
            name: "Fecha de inicio"
        },
        {
            data: "viaje_destino",
            name: "Lugar de destino"
        },
        
        {
            data: "viaje_fecha",
            name: "Fecha de viaje"
        },
        {
            data: "costo",
            name: "costo"
        },
        {
            data: "carga",
            name: "carga"
        },
        {
            data: "accion",
            name: "accion"
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
