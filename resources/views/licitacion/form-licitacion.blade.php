<div class="modal fade" id="{{ $idModal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          @if($tipo == "add")
          <h5 class="modal-title" id="exampleModalLabel">Nueva Licitación</h5>
          @else
          <h5 class="modal-title" id="exampleModalLabel">Editar Licitación</h5>
          @endif
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($tipo == "add")
          <form id="form-agregar-licitacion">
          <input type="hidden" name="_method" id="metodo" value="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" id="lic_nombre" minlength="1" maxlength="30" class="form-control" name="lic_nombre" required>
                <span class="invalid-feedback" role="alert" style="display: none">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Valor</label>
                <input type="text" id="lic_valor" minlength="1" maxlength="11" class="form-control" name="lic_valor" required>
                <span class="invalid-feedback" role="alert" style="display: none">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Empresa</label>
                <input type="text" id="lic_empresa" minlength="1" maxlength="30" class="form-control" name="lic_empresa" required>
                <span class="invalid-feedback" role="alert" style="display: none">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Rut Empresa</label>
                <input type="text"  id="lic_rut" minlength="1" maxlength="30" class="form-control" name="lic_rut" oninput= "checkRut(this)" required>
                <span class="invalid-feedback" role="alert" style="display: none">
              </div>
          @else
          <form id="form-editar-licitacion">
            <input type="hidden" name="id" id="id_licitacion" value="{{ $licitacion->id }}">
            <input type="hidden" name="_method" id="metodo" value="PUT">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="text" id="lic_nombre" value= "{{ $licitacion->lic_nombre }}" minlength="1" maxlength="30" class="form-control" name="lic_nombre" required>
                <span class="invalid-feedback" role="alert" style="display: none">
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Valor</label>
                <input type="text" id="lic_valor" value= "{{ $licitacion->lic_valor }}" minlength="1" maxlength="11" class="form-control" name="lic_valor" required>
                <span class="invalid-feedback" role="alert" style="display: none">
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Empresa</label>
                <input type="text" id="lic_empresa" value= "{{ $licitacion->lic_empresa }}" minlength="1" maxlength="30" class="form-control" name="lic_empresa" required>
                <span class="invalid-feedback" role="alert" style="display: none">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Rut Empresa</label>
                <input type="text"   id="lic_rut" value= "{{ $licitacion->lic_rut }}" minlength="1" maxlength="30" class="form-control" name="lic_rut" oninput= "checkRut(this)" required>
                <span class="invalid-feedback"  role="alert" style="display: none">
              </div>               
          @endif
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          @if ($tipo == "add")
          <button type="input" class="btn btn-primary agregar-licitacion" form="form-agregar-licitacion">Agregar Licitación</button>
          @else
          <button type="input" class="btn btn-primary editar-licitacion" form="form-editar-licitacion">Editar Licitación</button>
          @endif
        </div>
      </div>
    </div>
  </div>





  <script>

    function checkRut(rut) {
    
    var valor = rut.value.replace('.','');
  
    valor = valor.replace('-','');
    
    
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
  
    rut.value = cuerpo + '-'+ dv
    
    
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
  
    suma = 0;
    multiplo = 2;
    
    
    for(i=1;i<=cuerpo.length;i++) {
    
        
        index = multiplo * valor.charAt(cuerpo.length - i);
        
      
        suma = suma + index;
        
      
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    dvEsperado = 11 - (suma % 11);
    

    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;

    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
 
    rut.setCustomValidity('');
  }


</script>

