<h2>Mi Perfil</h2>
<div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Rut:</span>
        <span class="col-6">{{ $Usuario->usuarios_rut }}</span>
    </div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Nombre:</span>
        <span class="col-6">{{ $Usuario->usuarios_nombre }}</span>
    </div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Correo:</span>
        <span class="col-6">{{ $Usuario->usuarios_correo }}</span>
    </div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Teléfono:</span>
        <span class="col-6">{{ $Usuario->usuarios_telefono }}</span>
    </div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Dirección:</span>
        <span class="col-6">{{ $Usuario->usuarios_direccion }}</span>
    </div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Fecha Nacimiento:</span>
        <span class="col-6">{{ $Usuario->usuarios_fncto }}</span>
    </div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Vacunas:</span>
        <span class="col-6">{{ $Usuario->usuarios_vacuna }}</span>
    </div>
    <div class="row border-bottom border-dark p-2">
        <span class="col-6">Región:</span>
        <span class="col-6">{{ $Usuario->commune->region->name }}</span>
    </div>
    <div class="row p-2">
        <span class="col-6">Comuna:</span>
        <span class="col-6">{{ $Usuario->commune->name }}</span>
    </div>
    <button type="button" class="btn btn-primary editar-perfil">
        Editar Perfil
        </button>
</div>