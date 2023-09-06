<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Viaje;
use App\Usuarios;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ViajeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "19801204-1",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "973648274",
            'usuarios_correo' => "admins@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1997, 10, 25)->format('Y-m-d'),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);

        $this->actingAs($user);
        $response = $this->get('/viaje');

        $response->assertStatus(200);
    }

    public function testAdd()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "19801204-1",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "973648274",
            'usuarios_correo' => "admins@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1997, 10, 25)->format('Y-m-d'),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $test = $this->json('POST', '/viaje', [
            'usuarios_rut' => '19801204-1',
            'camion_id' => '2',
            'viaje_inicio' => Carbon::createFromDate(2021, 8, 1)->format('Y-m-d'),
            'viaje_lugar_inicio' => '1',
            'viaje_destino' => 'a',
            'viaje_fecha' => Carbon::createFromDate(2021, 8, 10)->format('Y-m-d'),
            'comuna_inicio_cod' => '1',
            'comuna_cod' => '2',
            'lic_cod' => '1',
        ]);

        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos guardados correctamente"
        ]);
    }

    public function testEdit()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "19801204-1",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "973648274",
            'usuarios_correo' => "admins@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1997, 10, 25)->format('Y-m-d'),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $Viaje = Viaje::orderBy('id', 'desc')->first();
        $test = $this->json('PUT', '/viaje', [
            'id' => $Viaje->id,
            'usuarios_rut' => '19801204-1',
            'camion_id' => '1',
            'viaje_inicio' => Carbon::createFromDate(2021, 8, 1)->format('Y-m-d'),
            'viaje_lugar_inicio' => 'cambio',
            'viaje_destino' => 'cambio',
            'viaje_fecha' => Carbon::createFromDate(2021, 8, 10)->format('Y-m-d'),
            'comuna_inicio_cod' => '1',
            'comuna_cod' => '2',
            'lic_cod' => '1',
        ]);

        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos guardados correctamente"
        ]);
    }

    public function testDelete()

    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "19801204-1",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "973648274",
            'usuarios_correo' => "admins@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1997, 10, 25)->format('Y-m-d'),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $Viaje = Viaje::orderBy('id', 'desc')->first();
        $test = $this->json('DELETE', '/viaje', [
            'id' => $Viaje->id
        ]);
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos eliminados correctamente"
        ]);
    }
}
