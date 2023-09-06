<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ver Carga</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
              <div class="row">
                  <span class="col-6">Nombre:</span>
                  <span class="col-6">{{ $Carga->nombre }}</span>
              </div>
              <div class="row">
                <span class="col-6">Peso:</span>
                <span class="col-6">{{ $Carga->peso }}</span>
            </div>
            <div class="row">
                <span class="col-6">Tipo:</span>
                <span class="col-6">{{ $Carga->tipo }}</span>
            </div>
            <div class="row">
                <span class="col-6">Cantidad:</span>
                <span class="col-6">{{ $Carga->cantidad }}</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
