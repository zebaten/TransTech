<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            @if ($tipo == "add")
            <h5 class="modal-title" id="exampleModalLabel">Nueva Carga</h5>
            @else
            <h5 class="modal-title" id="exampleModalLabel">Editar Carga</h5>
            @endif
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-carga">
          @if ($tipo == "add")
          <input type="hidden" name="_method" id="metodo" value="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" id="nombre" class="form-control" name="nombre" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Peso</label>
                <input type="number" id="peso" min="1" class="form-control" name="peso" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tipo</label>
                <input type="text" id="tipo" minlength="1" maxlength="30" class="form-control" name="tipo" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Cantidad</label>
                <input type="number" id="cantidad" min="1" class="form-control" name="cantidad" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
          @else
            <input type="hidden" name="id" id="id_carga" value="{{ $Carga->id }}">
            <input type="hidden" name="_method" id="metodo" value="PUT">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" id="nombre" class="form-control"  value="{{ $Carga->nombre }}" name="nombre" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Peso</label>
                <input type="number" id="peso" min="1" class="form-control" name="peso" value="{{ $Carga->peso }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tipo</label>
                <input type="text" id="tipo" minlength="1" maxlength="30" class="form-control" name="tipo" value="{{ $Carga->tipo }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Cantidad</label>
                <input type="number" id="cantidad" min="1" class="form-control" name="cantidad" value="{{ $Carga->cantidad }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>

          @endif
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          @if ($tipo == "add")
          <button type="input" class="btn btn-primary agregar-carga">Agregar Carga</button>
          @else
          <button type="input" class="btn btn-primary editar-carga">Editar Carga</button>
          @endif

        </div>
      </div>
    </div>
  </div>
