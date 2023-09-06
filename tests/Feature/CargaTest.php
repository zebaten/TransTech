<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Carga;
use App\Usuarios;
use App\Camion;
use App\Viaje;
use App\Licitacion;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CargaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "as as",
            'usuarios_rut' => "19334939-0",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@gmail.com",
            'usuarios_direccion' => "as 123",
            'usuarios_fncto' => Carbon::createFromDate(2000, 11, 30)->format('Y-m-d'),
            'usuarios_vacuna' => "si",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);

        $this->actingAs($user);
        $response = $this->get('/viaje/1/cargas');

        $response->assertStatus(200);
    }

    public function testAdd()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "as as",
            'usuarios_rut' => "19334939-0",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@gmail.com",
            'usuarios_direccion' => "as 123",
            'usuarios_fncto' => Carbon::createFromDate(2000, 11, 30)->format('Y-m-d'),
            'usuarios_vacuna' => "si",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);
        $this->actingAs($user);
        $test = $this->json('POST', '/viaje/1/cargas', [
            'peso' => '100',
            'viaje_id' => '1',
            'tipo' => 'muebles',
            'cantidad' => '1',
            'nombre' => 'mesa',
        ]);

        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos guardados correctamente"
        ]);
    }

    public function testEdit(){
        $user = new Usuarios([
            'usuarios_nombre' => "as as",
            'usuarios_rut' => "19334939-0",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@gmail.com",
            'usuarios_direccion' => "as 123",
            'usuarios_fncto' => Carbon::createFromDate(2000, 11, 30)->format('Y-m-d'),
            'usuarios_vacuna' => "si",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);
        $this->actingAs($user);
        $Carga = Carga::orderBy('id', 'desc')->first();
        $test = $this->json('PUT', '/viaje/1/cargas', [
            'id' => $Carga->id,
            'peso' => '99',
            'viaje_id' => '1',
            'tipo' => 'muebles',
            'cantidad' => '1',
            'nombre' => 'mesa',
        ]);
        $test->assertStatus(200)->assertJson([
            "estado" => "true"
        ]);
    }

    public function testDelete()

    {
        $user = new Usuarios([
            'usuarios_nombre' => "as as",
            'usuarios_rut' => "19334939-0",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@gmail.com",
            'usuarios_direccion' => "as 123",
            'usuarios_fncto' => Carbon::createFromDate(2000, 11, 30)->format('Y-m-d'),
            'usuarios_vacuna' => "si",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);
        $this->actingAs($user);
        $Carga = Carga::orderBy('id', 'desc')->first();
        $test = $this->json('DELETE', '/viaje/1/cargas', [
            'id' => $Carga->id
        ]);
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos eliminados correctamente"
        ]);
    }
}
