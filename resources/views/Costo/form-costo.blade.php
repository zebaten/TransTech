<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            @if ($tipo == "add")
              <h5 class="modal-title" id="exampleModalLabel">Nueva Costo</h5>
            @else
              <h5 class="modal-title" id="exampleModalLabel">Editar Costo</h5>
            @endif
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($tipo == "add")
          <form id="form-agregar-costo">
          
          <input type="hidden" name="_method" id="metodo" value="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" id="costos_nombre" minlength="1" maxlength="30" class="form-control" name="costos_nombre" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Costo</label>
                <input type="number" id="costos_costo" min="1" class="form-control" name="costos_costo" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Cantidad</label>
                <input type="number" id="costos_cantidad" min="1" class="form-control" name="costos_cantidad" required>
            </div>
          @else
          <form id="form-editar-costo">
            <input type="hidden" name="id" id="id_costo" value="{{ $costo->id }}">
            <input type="hidden" name="_method" id="metodo" value="PUT">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" value="{{ $costo->costos_nombre }}" id="costos_nombre" minlength="1" maxlength="30" class="form-control" name="costos_nombre" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Costo</label>
                <input type="number" value="{{ $costo->costos_costo }}" id="costos_costo" min="1" class="form-control" name="costos_costo" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Cantidad</label>
                <input type="number" value="{{ $costo->costos_cantidad }}" id="costos_cantidad" min="1" class="form-control" name="costos_cantidad" required>
            </div>
                
          @endif
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          @if ($tipo == "add")
          <button type="input" class="btn btn-primary agregar-costo" form="form-agregar-costo">Agregar Costo</button>
          @else
          <button type="input" class="btn btn-primary editar-costo" form="form-editar-costo">Editar Costo</button>
          @endif
          
        </div>
      </div>
    </div>
  </div>