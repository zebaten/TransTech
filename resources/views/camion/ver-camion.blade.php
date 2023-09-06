<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ver Camión</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
              <div class="row">
                  <span class="col-6">Patente:</span>
                  <span class="col-6">{{ $Camion->patente }}</span>
              </div>
              <div class="row">
                <span class="col-6">Marca:</span>
                <span class="col-6">{{ $Camion->marca }}</span>
            </div>
            <div class="row">
                <span class="col-6">Modelo:</span>
                <span class="col-6">{{ $Camion->modelo }}</span>
            </div>
            <div class="row">
                <span class="col-6">Año:</span>
                <span class="col-6">{{ $Camion->anio }}</span>
            </div>
            <div class="row">
                <span class="col-6">Peso:</span>
                <span class="col-6">{{ $Camion->peso }}</span>
            </div>
            <div class="row">
                <span class="col-6">Peso Máximo:</span>
                <span class="col-6">{{ $Camion->pesomax }}</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>