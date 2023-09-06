<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Usuarios;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UsuarioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testGet()
    {
        $response = $this->get('/usuarios');

        $response->assertStatus(302);
    }
    
    public function testGet2()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre Apellido",
            'usuarios_rut' => "19813775-8",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "971622497",
            'usuarios_correo' => "admin@email.cl",
            'usuarios_direccion' => "Calle falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);

        $this->actingAs($user);
        $response = $this->get('/usuarios');

        $response->assertStatus(200);
    }

    public function testAdd()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre Apellido",
            'usuarios_rut' => "19813775-8",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "971622497",
            'usuarios_correo' => "admin@email.cl",
            'usuarios_direccion' => "Calle falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);

        $this->actingAs($user);
        $test = $this->json('POST', '/usuarios', [
            'usuarios_nombre' => "Nombre Apellido",
            'usuarios_rut' => "19813779-0",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "971622497",
            'usuarios_correo' => "correo@email.cl",
            'usuarios_direccion' => "Calle falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14)->format('Y-m-d'),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);

        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos guardados correctamente"
        ]);
    }

    public function testEdit()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre Apellido",
            'usuarios_rut' => "19813775-8",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "971622497",
            'usuarios_correo' => "admin@email.cl",
            'usuarios_direccion' => "Calle falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);

        $this->actingAs($user);
        $Usuario = Usuarios::orderBy('id', 'desc')->first();
        $test = $this->json('PUT', '/usuarios', [
            'id' => $Usuario->id,
            'usuarios_nombre' => "Nombre Apellido",
            'usuarios_rut' => "19813779-0",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "971622497",
            'usuarios_correo' => "name@user.cl",
            'usuarios_direccion' => "Calle falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14)->format('Y-m-d'),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);
        $test->assertStatus(200)->assertJson([
            "estado" => "true"
        ]);
        
    }

    public function testDelete()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre Apellido",
            'usuarios_rut' => "19813775-8",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "971622497",
            'usuarios_correo' => "admin@email.cl",
            'usuarios_direccion' => "Calle falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);

        $this->actingAs($user);
        $Usuario = Usuarios::orderBy('id', 'desc')->first();
        $test = $this->json('DELETE', '/usuarios', [
            'id' => $Usuario->id
        ]);
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos eliminados correctamente"
        ]);
    }
}
