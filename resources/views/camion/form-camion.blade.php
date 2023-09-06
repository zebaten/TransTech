<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          @if ($tipo == "add")
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Camion</h5> 
          @else
          <h5 class="modal-title" id="exampleModalLabel">Editar Camión</h5>
          @endif
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($tipo == "add")
          <form id="form-agregar-camion">
          
          <input type="hidden" name="_method" id="metodo" value="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Patente</label>
                <input type="text" id="patente" pattern="[A-Z]{2}-[0-9]{4}|[B-DF-HJ-NP-TV-Z]{4}-[0-9]{2}" onkeyup="this.value = this.value.toUpperCase();" class="form-control" name="patente" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Marca</label>
                <input type="text" id="marca" minlength="1" maxlength="30" class="form-control" name="marca" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Modelo</label>
                <input type="text" id="modelo" minlength="1" maxlength="30" class="form-control" name="modelo" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Año</label>
                <input type="number" id="anio" min="1990" class="form-control" name="anio" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Peso Camión</label>
                <input type="number" id="pesocam" min="1" class="form-control" name="pesocam" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Peso Máximo</label>
                <input type="number" id="pesomax" min="1" class="form-control" name="pesomax" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
          @else
          <form id="form-editar-camion">
            <input type="hidden" name="id" id="id_camion" value="{{ $Camion->id }}">
            <input type="hidden" name="_method" id="metodo" value="PUT">
            <div class="form-group">
                <label for="exampleInputEmail1">Patente</label>
                <input type="text" id="patente" pattern="[A-Z]{2}-[0-9]{4}|[B-DF-HJ-NP-TV-Z]{4}-[0-9]{2}" onkeyup="this.value = this.value.toUpperCase();" class="form-control"  value="{{ $Camion->patente }}" name="patente" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Marca</label>
                <input type="text" id="marca" minlength="1" maxlength="30" class="form-control" name="marca" value="{{ $Camion->marca }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Modelo</label>
                <input type="text" id="modelo" minlength="1" maxlength="30" class="form-control" name="modelo" value="{{ $Camion->modelo }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Año</label>
                <input type="number" id="anio" min="1990" class="form-control" name="anio" value="{{ $Camion->anio }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Peso Camión (Ton)</label>
                <input type="number" id="pesocam" min="1" class="form-control" name="pesocam" value="{{ $Camion->peso }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Peso Máximo (Ton)</label>
                <input type="number" id="pesomax" min="1" class="form-control" name="pesomax" value="{{ $Camion->pesomax }}" required>
                <span class="invalid-feedback" role="alert" style="display: none">
                </span>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Estado Camión</label>
              <select name="estado" class="form-control" id="estado" required>
                <option value="1" {{ $Camion->estado == 1? "selected": "" }}>Activo</option>
                <option value="2" {{ $Camion->estado == 2? "selected": "" }}>Inactivo</option>
              </select>
              </span>
          </div>
                
          @endif
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          @if ($tipo == "add")
          <button type="input" class="btn btn-primary agregar-camion" form="form-agregar-camion">Agregar Camión</button>
          @else
          <button type="input" class="btn btn-primary editar-camion" form="form-editar-camion">Editar Camión</button>
          @endif
          
        </div>
      </div>
    </div>
  </div>