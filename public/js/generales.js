/* Este codigo crea la modal de carga para cerrar se debe usar modal.out()*/
var modal;
function cargando(title,descripcion) {
    var loading = new Loading({
        direction: 'hor',
        discription: descripcion,
        title: title,
        animationIn: false,
        animationOut: false,
        defaultApply: 	true,
    });
    return loading;
}

function ajaxRequest(url, id = 0, tipo, idFormulario, idDataTable, idModal = ""){
    let formulario = document.getElementById(idFormulario);
    $(".invalid-feedback").hide();
    if(formulario){
        var formdata = new FormData(formulario);
    }
    else{
        var formdata = new FormData();
    }
    formdata.append("_method", tipo);
    formdata.append('_token',$('meta[name="csrf-token"]').attr('content'));
    if(id != 0){
        formdata.append("id", id);
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        processData: false,
        contentType: false,
        type: 'POST',
        data : formdata,
        success: function(data){
            modal.out();
            if(data.estado == "true"){
                Swal.fire({
                    type: 'success',
                    title: data.mensaje
                });
                if(idModal != ""){
                    $("#"+idModal).modal("hide");
                }
                if(url == "perfil"){
                    $("#perfil").load('perfil', {_token: $('meta[name="csrf-token"]').attr('content')});
                }
            }
            else{
                Swal.fire({
                    type: 'error',
                    title: data.mensaje
                });
                return 0;
            }
            if(idDataTable != ""){
                $("#"+idDataTable).DataTable().ajax.reload();
            }
            
        },
        error: function(jqXHR){
            modal.out();
            if(jqXHR.status == 302){
                location.href = '/login';
            }
            else if(jqXHR.status == 422){
                var response = JSON.parse(jqXHR.responseText);
                $.each(response.errors, function(key, value){
                    $("[name='"+key+"']").next(".invalid-feedback").html("<strong>"+value+"</strong>").show();
                });
                Swal.fire({
                    type: 'error',
                    title: 'Ha ocurrido un error',
                    text: 'Los datos ingresados no son validos'
                  });
            }
            
              return 0;
        }
    })
    return 1;
}

function ajaxModal(url, id = 0, idModal){
    let newmodal = document.getElementById(idModal);
    
    if(newmodal){
        newmodal.remove()
    }
    $("#modales").load(url, {_token: $('meta[name="csrf-token"]').attr('content'), id: id , idModal: idModal}, function(){
        $("#"+idModal).modal("show");
    });
    modal.out();
}
