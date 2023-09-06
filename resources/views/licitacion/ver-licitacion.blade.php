<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ver Licitación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
              <div class="row">
                  <span class="col-6">Código:</span>
                  <span class="col-6">{{ $licitacion->id }}</span>
              </div>
              <div class="row">
                <span class="col-6">Nombre:</span>
                <span class="col-6">{{ $licitacion->lic_nombre }}</span>
            </div>
            <div class="row">
                <span class="col-6">Valor:</span>
                <span class="col-6">{{ $licitacion->lic_valor }}</span>
            </div>
            <div class="row">
                <span class="col-6">Empresa:</span>
                <span class="col-6">{{ $licitacion->lic_empresa }}</span>
            </div>
            <div class="row">
                <span class="col-6">Rut:</span>
                <span class="col-6">{{ $licitacion->lic_rut }}</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>