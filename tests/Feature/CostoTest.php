<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Costo;
use App\Usuarios;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


class CostoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testAdd()
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "19723548-9",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "944444444",
            'usuarios_correo' => "admin@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);
        $this->actingAs($user);
        $test = $this->json('POST', '/viaje/1/costos', [
            'viaje_id' => '1',
            'costos_nombre' => 'costo',
            'costos_costo' => '500',
            'costos_cantidad' => '5'
        ]);
        
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos guardados correctamente"
        ]);
    }

    

    public function testEdit(){
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "19723548-9",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "944444444",
            'usuarios_correo' => "admin@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 2,
        ]);
        $this->actingAs($user);
        $Costos = Costo::orderBy('id', 'desc')->first();
        $test = $this->json('PUT', '/viaje/1/costos', [
            'id' => $Costos->id,
            'viaje_id' => '1',
            'costos_nombre' => 'costo',
            'costos_costo' => '400',
            'costos_cantidad' => '5'
        ]);
        $test->assertStatus(200)->assertJson([
            "estado" => "true"
        ]);
    }

    

    public function testDelete()
    
    {
        $user = new Usuarios([
            'usuarios_nombre' => "Nombre",
            'usuarios_rut' => "19723548-9",
            'usuarios_password' => Hash::make("test1234"),
            'usuarios_telefono' => "944444444",
            'usuarios_correo' => "admin@admin.cl",
            'usuarios_direccion' => "Direccion falsa 123",
            'usuarios_fncto' => Carbon::createFromDate(1993,7,14),
            'usuarios_vacuna' => "Pfizer",
            'comuna_cod' => 1,
            'rol_cod' => 1,
        ]);
        $this->actingAs($user);
        $Costos = Costo::orderBy('id', 'desc')->first();
        $test = $this->json('DELETE', '/viaje/1/costos', [
            'id' => $Costos->id
        ]);
        $test->assertStatus(200)->assertExactJson([
            "estado" => "true",
            "mensaje" => "Datos eliminados correctamente"
        ]);
    }

}
