<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Viaje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <span class="col-6">Código de viaje:</span>
                        <span class="col-6">{{ $Viaje->id }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Rut Camionero:</span>
                        <span class="col-6">{{ $Viaje->usuarios_rut }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Patente Camión:</span>
                        <span class="col-6">{{ $camion->patente }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Lugar inicio:</span>
                        <span class="col-6">{{ $Viaje->viaje_lugar_inicio }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Región inicio:</span>
                        <span class="col-6">{{ $regioninicio->name }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Comuna inicio:</span>
                        <span class="col-6">{{ $comunainicio->name }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Lugar destino:</span>
                        <span class="col-6">{{ $Viaje->viaje_destino }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Fecha de inicio:</span>
                        <span class="col-6">{{ $Viaje->viaje_inicio }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Fecha fin:</span>
                        <span class="col-6">{{ $Viaje->viaje_fecha }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Región destino:</span>
                        <span class="col-6">{{ $region->name }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Comuna destino:</span>
                        <span class="col-6">{{ $comuna->name }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Nombre de licitación:</span>
                        <span class="col-6">{{ $licitacion->lic_nombre }}</span>
                    </div>
                    <div class="row">
                        <span class="col-6">Costo total:</span>
                        <span class="col-1">{{ $costoTotal }}
                        </span>
                        <div class="col-5">
                            <a href='viaje/{{ $Viaje->id }}/costos' class='btn btn-sm btn-outline-primary m-1 px-3'
                                title='Ver'>
                                <i class='fas fa-bars'></i>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <span class="col-6">Peso total:</span>

                        <span class="col-1">{{ $pesoTotal }}
                        </span>
                        <div class="col-5">
                            <a href='viaje/{{ $Viaje->id }}/cargas' class='btn btn-sm btn-outline-primary m-1 px-3'
                                title='Ver'>
                                <i class='fas fa-bars'></i>

                            </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
