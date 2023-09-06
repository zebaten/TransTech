<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-editar-perfil">
                    <input type="hidden" name="_method" id="metodo" value="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rut</label>
                        <input type="number" id="usuarios_rut" minlength="7" maxlength="8"
                            value="{{ $Usuario->usuarios_rut }}" class="form-control" name="usuarios_rut" readonly>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Contraseña</label>
                        <input type="password" id="password" minlength="1" maxlength="30" value="" class="form-control"
                            name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" id="usuarios_nombre" minlength="1" maxlength="30"
                            value="{{ $Usuario->usuarios_nombre }}" class="form-control" name="usuarios_nombre"
                            required>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo</label>
                        <input type="text" id="usuarios_correo" minlength="1" maxlength="30"
                            value="{{ $Usuario->usuarios_correo }}" class="form-control" name="usuarios_correo"
                            required>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="exampleInputEmail1">Código</label>
                            <input type="text" class="form-control" value="+56" readonly>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                        <div class="form-group col-9">
                            <label for="exampleInputEmail1">Teléfono</label>
                            <input type="number" id="usuarios_telefono" maxlength="9"
                                value="{{ $Usuario->usuarios_telefono }}" class="form-control"
                                name="usuarios_telefono" required>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dirección</label>
                        <input type="text" id="usuarios_direccion" minlength="1" maxlength="30"
                            value="{{ $Usuario->usuarios_direccion }}" class="form-control" name="usuarios_direccion"
                            required>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Año</label>
                        <input type="date" id="usuarios_fncto" min="1900" class="form-control"
                            value="{{ $Usuario->usuarios_fncto }}" name="usuarios_fncto" required>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Vacunas</label>
                        <input type="text" id="usuarios_vacuna" minlength="1" maxlength="30"
                            value="{{ $Usuario->usuarios_vacuna }}" class="form-control" name="usuarios_vacuna"
                            required>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Región</label>
                        <select id="region" name="region" class="form-control" onchange="llenarcomunas()" required>
                            <option value="">Seleccione Region</option>
                            @foreach ($regiones as $region)
                                @if ($region->id == $Usuario->commune->region->id)
                                    <option value="{{ $region->id }}" selected>{{ $region->name }}</option>
                                @else
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endif

                            @endforeach
                        </select>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Comuna</label>
                        <select id="comuna_cod" name="comuna_cod" class="form-control" required>
                            <option selected value="">Seleccione Comuna</option>
                        </select>
                        <span class="invalid-feedback" role="alert" style="display: none">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="input" class="btn btn-primary editar-usuario" form="form-editar-perfil">Editar
                    Perfil</button>
            </div>
        </div>
    </div>
</div>

<script>
    function llenarcomunas(id_comuna) {
        document.getElementById("comuna_cod").disabled = true;
        $.ajax({
            url: 'ver-comunas',
            type: 'POST',
            data: {
                id: $("#region").val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(data, status, xhr) {
                $("#comuna_cod").empty();
                $("#comuna_cod").append('<option value="">Seleccione una comuna</option>');
                data.forEach(obj => {
                    $("#comuna_cod").append('<option value="' + obj.id + '">' + obj.name +
                        '</option>');
                });
                document.getElementById("comuna_cod").disabled = false;
                document.getElementById("comuna_cod").readOnly = false;
                if (id_comuna != undefined) {
                    $("#comuna_cod").val(id_comuna);
                }
            }
        });
    }

    $(document).ready(function() {
        llenarcomunas({{ $Usuario->comuna_cod }});
    })
</script>
