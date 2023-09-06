$(document).on("click",".editar-perfil",function(e) {
    modal = cargando("Cargando");
    ajaxModal("modal-perfil-edit", 0, "editar-perfil");
})

$(document).on("submit","#form-editar-perfil",function(e) {
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
            modal = cargando("Editando Perfil");
            ajaxRequest("perfil", 0, "PUT", "form-editar-perfil", "", "editar-perfil");
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
