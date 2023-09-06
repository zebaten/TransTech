<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Usuarios;
use App\Licitacion;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class LicitacionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGet()
    {
        $response = $this->get('/licitaciones');

        $response->assertStatus(302);
    }

    public function testGet2(){
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "18322066-7",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $response = $this->get('/licitaciones');

        $response->assertStatus(200);

    }


    public function testAdd()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "18322066-7",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $test = $this->json('POST', '/licitaciones', [
            'lic_rut' => '1981377-0',
            'lic_nombre' => 'Men01',
            'lic_empresa' => 'Trastech2',
            'lic_valor' => '1005'

        ]);

        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos guardados correctamente"
        ]);
    }

    public function testEdit(){
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "18322066-7",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $Licitacion = Licitacion::orderBy('id', 'desc')->first();
        $test = $this->json('PUT', '/licitaciones', [
            'id' => $Licitacion ->id,
            'lic_rut' => '1981377-0',
            'lic_nombre' => 'Men01',
            'lic_empresa' => 'Trastech2',
            'lic_valor' => '1005'
        ]);
        $test->assertStatus(200)->assertJson([
            "estado" => "true"
        ]);
    }




    
    public function testDelete()
    
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "18322066-7",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "952420476",
            'usuarios_correo' => "admin@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $Licitacion = Licitacion::orderBy('id', 'desc')->first();
        $test = $this->json('DELETE', '/licitaciones', [
            'id' => $Licitacion->id
        ]);
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos eliminados correctamente"
        ]);
    }


}
