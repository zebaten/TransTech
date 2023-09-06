<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Camion;
use App\Usuarios;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CamionTest extends TestCase
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
        $response = $this->get('/camiones');

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
        $test = $this->json('POST', '/camiones', [
            'patente' => 'CCCC-11',
            'marca' => 'Ford',
            'modelo' => '1000', 
            'anio' => '2000', 
            'pesocam'=> '20', 
            'pesomax' => '50'
        ]);
        
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos guardados correctamente"
        ]);
    }

    public function testAdd2()
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
        
        $test = $this->json('POST', '/camiones', [
            'patente' => 'CCCC-1',
            'marca' => '',
            'modelo' => '', 
            'anio' => '1900', 
            'pesocam'=> '0', 
            'pesomax' => '0'
        ]);
        //dd($test['errors']);
        //Error 422 al no pasar la validacion por servidor
        $test->assertStatus(422);
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
        $Camion = Camion::orderBy('id', 'desc')->first();
        $test = $this->json('PUT', '/camiones', [
            'id' => $Camion->id,
            'patente' => 'CCCC-11',
            'marca' => 'Ford2',
            'modelo' => '1000', 
            'anio' => '2000', 
            'pesocam'=> '20', 
            'pesomax' => '50',
            'estado' => '1'
        ]);
        $test->assertStatus(200)->assertJson([
            "estado" => "true"
        ]);
    }

    public function testEdit2(){
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
        $test = $this->json('PUT', '/camiones', [
            'id' => '1000',
            'patente' => 'CCCC-11',
            'marca' => 'Ford2',
            'modelo' => '1000', 
            'anio' => '2000', 
            'pesocam'=> '20', 
            'pesomax' => '50'
        ]);
        //dd($test);

        $test->assertStatus(200)->assertJson([
            "estado" => "false"
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
        $Camion = Camion::orderBy('id', 'desc')->first();
        $test = $this->json('DELETE', '/camiones', [
            'id' => $Camion->id
        ]);
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos eliminados correctamente"
        ]);
    }

    public function testDelete2()
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
        $test = $this->json('DELETE', '/camiones', [
            'id' => '1000'
        ]);
        $test->assertStatus(200)->assertJson([
            "estado" => "false",
        ]);
    }

    
}
