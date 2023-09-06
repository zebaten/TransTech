<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ver Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
              <div class="row">
                  <span class="col-6">Rut:</span>
                  <span class="col-6">{{ $Usuario->usuarios_rut }}</span>
              </div>
            <div class="row">
                <span class="col-6">Nombre:</span>
                <span class="col-6">{{ $Usuario->usuarios_nombre }}</span>
            </div>
            <div class="row">
                <span class="col-6">Correo:</span>
                <span class="col-6">{{ $Usuario->usuarios_correo }}</span>
            </div>
            <div class="row">
                <span class="col-6">Dirección:</span>
                <span class="col-6">{{ $Usuario->usuarios_direccion }}</span>
            </div>
            <div class="row">
                <span class="col-6">Año:</span>
                <span class="col-6">{{ $Usuario->usuarios_fncto }}</span>
            </div>
            <div class="row">
              <span class="col-6">Vacuna:</span>
              <span class="col-6">{{ $Usuario->usuarios_vacuna }}</span>
            </div>
            <div class="row">
              <span class="col-6">Región:</span>
              <span class="col-6">{{ $Usuario->commune->region->name }}</span>
          </div>
          <div class="row">
              <span class="col-6">Comuna:</span>
              <span class="col-6">{{ $Usuario->commune->name }}</span>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>