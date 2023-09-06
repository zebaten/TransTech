<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'usuarios_nombre',
        'usuarios_rut',
        'usuarios_password',
        'usuarios_telefono',
        'usuarios_correo',
        'usuarios_direccion',
        'usuarios_fncto',
        'usuarios_vacuna',
        'comuna_cod',
        'rol_cod'
    ];
    //
    public function commune()
    {
        return $this->belongsTo('\App\Commune','comuna_cod','id');
    }
}
