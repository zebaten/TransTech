<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if ($tipo == 'add')
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                @else
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($tipo == 'add')
                    <form id="form-agregar-usuario">
                        <input type="hidden" name="_method" id="metodo" value="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Rut</label>
                            <input type="text" id="usuarios_rut" class="form-control" name="usuarios_rut"
                                oninput="checkRut(this)" required>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="exampleInputEmail1">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="password" minlength="1" maxlength="30"
                                        class="form-control" name="password" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button"
                                            onclick="mostrarContrasena()">Mostrar Contraseña</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" id="usuarios_nombre" minlength="1" maxlength="30" class="form-control"
                                name="usuarios_nombre" onkeypress="return soloLetras(event)" required>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo</label>
                            <input type="text" id="usuarios_correo" minlength="1" maxlength="30" class="form-control"
                                name="usuarios_correo"
                                pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                                required>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="exampleInputEmail1">Código</label>
                                <input type="text" class="form-control" value="+56" readonly>
                            </div>
                            <div class="form-group col-9">
                                <label for="exampleInputEmail1">Teléfono</label>
                                <input type="text" id="usuarios_telefono" pattern="[0-9]{9}" class="form-control"
                                    name="usuarios_telefono"
                                    onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                    required>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dirección</label>
                            <input type="text" id="usuarios_direccion" minlength="1" maxlength="30" class="form-control"
                                name="usuarios_direccion" required>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha de nacimiento</label>
                            <input type="date" id="usuarios_fncto" min="1970-01-01" max="2000-12-31"
                                class="form-control" name="usuarios_fncto" required>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Vacunas</label>
                            <input type="text" id="usuarios_vacuna" minlength="1" maxlength="30" class="form-control"
                                name="usuarios_vacuna" required>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Región</label>
                            <select id="region" name="region" class="form-control" onchange="llenarcomunas()" required>
                                <option value="">Seleccione Region</option>
                                @foreach ($regiones as $region).
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Rol</label>
                            <select id="rol_cod" name="rol_cod" class="form-control" required>
                                <option selected value="">Seleccione Rol</option>
                                <option value="1">Administrador</option>
                                <option value="2">Conductor</option>
                            </select>
                            <span class="invalid-feedback" role="alert" style="display: none">
                        </div>
                    @else
                        <form id="form-editar-usuario">
                            <input type="hidden" name="id" id="id_usuario" value="{{ $Usuario->id }}">
                            <input type="hidden" name="_method" id="metodo" value="PUT">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Rut</label>
                                <input type="text" id="usuarios_rut" class="form-control" name="usuarios_rut"
                                    value="{{ $Usuario->usuarios_rut }}" oninput="checkRut(this)" required>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Contraseña</label>
                                <input type="password" id="password" minlength="1" maxlength="30" class="form-control"
                                    name="password">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button" onclick="mostrarContrasena()">Mostrar
                                        Contraseña</button>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="text" id="usuarios_nombre" minlength="1" maxlength="30"
                                    class="form-control" name="usuarios_nombre" onkeypress="return soloLetras(event)"
                                    value="{{ $Usuario->usuarios_nombre }}" required>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Correo</label>
                                <input type="text" id="usuarios_correo" minlength="1" maxlength="30"
                                    class="form-control" name="usuarios_correo"
                                    value="{{ $Usuario->usuarios_correo }}" required>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="exampleInputEmail1">Código</label>
                                    <input type="text" class="form-control" value="+56" readonly>
                                </div>
                                <div class="form-group col-9">
                                    <label for="exampleInputEmail1">Teléfono</label>
                                    <input type="number" id="usuarios_telefono" pattern="[0-9]{9}" class="form-control"
                                        name="usuarios_telefono"
                                        onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                        value="{{ $Usuario->usuarios_telefono }}" required>
                                    <span class="invalid-feedback" role="alert" style="display: none">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dirección</label>
                                <input type="text" id="usuarios_direccion" minlength="1" maxlength="30"
                                    class="form-control" name="usuarios_direccion"
                                    value="{{ $Usuario->usuarios_direccion }}" required>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                <input type="date" id="usuarios_fncto" min="1990" class="form-control"
                                    name="usuarios_fncto" value="{{ $Usuario->usuarios_fncto }}" required>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Vacunas</label>
                                <input type="text" id="usuarios_vacuna" minlength="1" maxlength="30"
                                    class="form-control" name="usuarios_vacuna"
                                    value="{{ $Usuario->usuarios_vacuna }}" required>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Región</label>
                                <select id="region" name="region" class="form-control" onchange="llenarcomunas()"
                                    required>
                                    <option value="">Seleccione Región</option>
                                    @foreach ($regiones as $region)
                                        @if ($region->id == $comunas->region_id)
                                            <option value="{{ $region->id }}" selected>{{ $region->name }}
                                            </option>
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
                                    <option selected value="{{ $Usuario->comuna_cod }}">{{ $comunas->name }}
                                    </option>
                                </select>
                                <span class="invalid-feedback" role="alert" style="display: none">
                            </div>
                @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                @if ($tipo == 'add')
                    <button type="input" class="btn btn-primary agregar-usuario" form="form-agregar-usuario">Agregar
                        Usuario</button>
                @else
                    <button type="input" class="btn btn-primary editar-usuario" form="form-editar-usuario">Editar
                        Usuario</button>
                @endif
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

    function mostrarContrasena() {
        var tipo = document.getElementById("password");
        if (tipo.type == "password") {
            tipo.type = "text";
        } else {
            tipo.type = "password";
        }
    }

    function checkRut(rut) {
        // Despejar Puntos
        var valor = rut.value.replace('.', '');
        // Despejar Guión
        valor = valor.replace('-', '');

        // Aislar Cuerpo y Dígito Verificador
        cuerpo = valor.slice(0, -1);
        dv = valor.slice(-1).toUpperCase();

        // Formatear RUN
        rut.value = cuerpo + '-' + dv

        // Si no cumple con el mínimo ej. (n.nnn.nnn)
        if (cuerpo.length < 7) {
            rut.setCustomValidity("RUT Incompleto");
            return false;
        }

        // Calcular Dígito Verificador
        suma = 0;
        multiplo = 2;

        // Para cada dígito del Cuerpo
        for (i = 1; i <= cuerpo.length; i++) {

            // Obtener su Producto con el Múltiplo Correspondiente
            index = multiplo * valor.charAt(cuerpo.length - i);

            // Sumar al Contador General
            suma = suma + index;

            // Consolidar Múltiplo dentro del rango [2,7]
            if (multiplo < 7) {
                multiplo = multiplo + 1;
            } else {
                multiplo = 2;
            }

        }

        // Calcular Dígito Verificador en base al Módulo 11
        dvEsperado = 11 - (suma % 11);

        // Casos Especiales (0 y K)
        dv = (dv == 'K') ? 10 : dv;
        dv = (dv == 0) ? 11 : dv;

        // Validar que el Cuerpo coincide con su Dígito Verificador
        if (dvEsperado != dv) {
            rut.setCustomValidity("RUT Inválido");
            return false;
        }

        // Si todo sale bien, eliminar errores (decretar que es válido)
        rut.setCustomValidity('');
    }

    function soloLetras(e) {
        var key = e.keyCode || e.which,
            tecla = String.fromCharCode(key).toLowerCase(),
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz",
            especiales = [8, 37, 39, 46],
            tecla_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }
    $(document).ready(function() {
        var treedata = <?php echo isset($Usuario->comuna_cod) ? '"' . $Usuario->comuna_cod . '"' : "''"; ?>;
        llenarcomunas(treedata);
    })
</script>
