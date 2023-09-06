<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if ($tipo == 'add')
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo viaje</h5>
                @else
                    <h5 class="modal-title" id="exampleModalLabel">Editar viaje</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($tipo == 'add')
                    <form id="form-agregar-viaje">
                        <input type="hidden" name="_method" id="metodo" value="POST">
                        <label for="exampleInputEmail1">Camionero</label>
                        <div class="form-group">
                            <select id="usuarios_rut" name="usuarios_rut" class="form-control" required>
                                <option value="">Seleccione Camionero</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->usuarios_rut }}">{{ $usuario->usuarios_nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Camión</label>
                            <select id="camion_id" name="camion_id" class="form-control" required>
                                <option value="">Seleccione Camión</option>
                                @foreach ($camiones as $camion)
                                    <option value="{{ $camion->id }}">{{ $camion->patente }}
                                    </option>
                                @endforeach
                            </select><span class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lugar inicio</label>
                            <input type="text" id="viaje_lugar_inicio" minlength="1" maxlength="30" class="form-control"
                                name="viaje_lugar_inicio" required><span class="invalid-feedback" role="alert"
                                style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha inicio</label>
                            <input type="date" id="viaje_inicio" class="form-control" name="viaje_inicio" required><span
                                class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Región inicio</label>
                            <select id="region_inicio" name="region_inicio" class="form-control"
                                onchange="llenarcomunasinicio()" required>
                                <option value="">Seleccione Region</option>
                                @foreach ($regiones as $regioninicio)
                                    <option value="{{ $regioninicio->id }}">{{ $regioninicio->name }}</option>
                                @endforeach
                            </select><span class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Comuna inicio</label>
                            <select id="comuna_inicio_cod" name="comuna_inicio_cod" class="form-control" required>
                                <option selected value="">Seleccione una Comuna</option>
                            </select><span class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lugar destino</label>
                            <input type="text" id="viaje_destino" minlength="1" maxlength="30" class="form-control"
                                name="viaje_destino" required><span class="invalid-feedback" role="alert"
                                style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Fecha fin</label>
                            <input type="date" id="viaje_fecha" class="form-control" name="viaje_fecha" required><span
                                class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Región destino</label>
                            <select id="region" name="region" class="form-control" onchange="llenarcomunas()" required>
                                <option value="">Seleccione Region</option>
                                @foreach ($regiones as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select><span class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Comuna destino</label>
                            <select id="comuna_cod" name="comuna_cod" class="form-control" required>
                                <option selected value="">Seleccione una Comuna</option>
                            </select><span class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Licitación</label>
                            <select id="lic_cod" name="lic_cod" class="form-control" required>
                                <option value="">Seleccione licitación</option>
                                @foreach ($licitaciones as $l)
                                    <option value="{{ $l->id }}">{{ $l->lic_nombre }}</option>
                                @endforeach
                            </select><span class="invalid-feedback" role="alert" style="display: none">
                            </span>
                        </div>
                    @else
                        <form id="form-editar-viaje">
                            <input type="hidden" name="id" id="id" value="{{ $Viaje->id }}">
                            <input type="hidden" name="_method" id="metodo" value="PUT">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Camionero</label>
                                <select id="usuarios_rut" name="usuarios_rut" class="form-control" required>
                                    <option value="{{ $usuario->usuarios_rut }}">{{ $usuario->usuarios_nombre }}
                                    </option>
                                    @foreach ($usuarios as $u)
                                        @if ($usuario->id != $u->id)
                                            <option value="{{ $u->usuarios_rut }}">{{ $u->usuarios_nombre }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Camión</label>
                                <select id="camion_id" name="camion_id" class="form-control" required>
                                    <option value="{{ $camion->id }}">{{ $camion->patente }}
                                    </option>
                                    @foreach ($camiones as $c)
                                        @if ($camion->id != $c->id)
                                            <option value="{{ $c->id }}">{{ $c->patente }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lugar inicio</label>
                                <input type="text" id="viaje_lugar_inicio" minlength="1" maxlength="30"
                                    class="form-control" name="viaje_lugar_inicio"
                                    value="{{ $Viaje->viaje_lugar_inicio }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha inicio</label>
                                <input type="date" id="viaje_inicio" class="form-control" name="viaje_inicio"
                                    value="{{ $Viaje->viaje_inicio }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Región inicio</label>
                                <select id="region_inicio" name="region_inicio" class="form-control"
                                    onclick="llenarcomunasinicio()" required>
                                    <option value="{{ $comunasinicio->region_id }}" selected>
                                        {{ $regioninicio->name }}
                                    </option>
                                    @foreach ($regionesinicio as $regioninicio)
                                        <option value="{{ $regioninicio->id }}">{{ $regioninicio->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Comuna inicio</label>
                                <select id="comuna_inicio_cod" name="comuna_inicio_cod" class="form-control" required>
                                    <option selected value="">Seleccione una Comuna</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lugar destino</label>
                                <input type="text" id="viaje_destino" minlength="1" maxlength="30" class="form-control"
                                    name="viaje_destino" value="{{ $Viaje->viaje_destino }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fecha fin</label>
                                <input type="date" id="viaje_fecha" class="form-control" name="viaje_fecha"
                                    value="{{ $Viaje->viaje_fecha }}" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Región destino</label>
                                <select id="region" name="region" class="form-control" onchange="llenarcomunas()"
                                    onclick="llenarcomunas()" required>
                                    <option value="{{ $comunas->region_id }}" selected>{{ $region->name }}
                                    </option>
                                    @foreach ($regiones as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Comuna destino</label>
                                <select id="comuna_cod" name="comuna_cod" class="form-control" required>
                                    <option selected value="">Seleccione Comuna</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Licitación</label>
                                <select id="lic_cod" name="lic_cod" class="form-control" required>
                                    <option value="{{ $licitacion->id }}">{{ $licitacion->lic_nombre }}</option>
                                    @foreach ($licitaciones as $l)
                                        @if ($licitacion->id != $l->id)
                                            <option value="{{ $l->id }}">{{ $l->lic_nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                @endif
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                @if ($tipo == 'add')
                    <button type="input" class="btn btn-primary agregar-viaje" form="form-agregar-viaje">Agregar
                        Viaje</button>
                @else
                    <button type="input" class="btn btn-primary editar-viaje" form="form-editar-viaje">Editar
                        Viaje</button>
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
                $("#comuna_cod").append('<option value="">Seleccione una Comuna</option>');
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

    function llenarcomunasinicio(id_comuna) {
        document.getElementById("comuna_inicio_cod").disabled = true;
        $.ajax({
            url: 'ver-comunas',
            type: 'POST',
            data: {
                id: $("#region_inicio").val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(data, status, xhr) {
                $("#comuna_inicio_cod").empty();
                $("#comuna_inicio_cod").append('<option value="">Seleccione una comuna</option>');
                data.forEach(obj => {
                    $("#comuna_inicio_cod").append('<option value="' + obj.id + '">' + obj.name +
                        '</option>');
                });
                document.getElementById("comuna_inicio_cod").disabled = false;
                document.getElementById("comuna_inicio_cod").readOnly = false;
                if (id_comuna != undefined) {
                    $("#comuna_inicio_cod").val(id_comuna);
                }
            }
        });
    }
    $(document).ready(function() {
        var treedata = <?php echo isset($Viaje->comuna_cod) ? '"' . $Viaje->comuna_cod . '"' : "''"; ?>;
        llenarcomunas(treedata);
        var treedata2 = <?php echo isset($Viaje->comuna_inicio_cod) ? '"' . $Viaje->comuna_inicio_cod . '"' : "''"; ?>;
        llenarcomunasinicio(treedata2);
    })
</script>
