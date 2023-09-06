<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('prueba', 'PruebaController@index');

Route::post('prueba', 'PruebaController@add');

Route::post('pruebalist', 'PruebaController@list');

Route::delete('prueba', 'PruebaController@delete');


Auth::routes();

Route::get('/home', 'HomeController@index');

//Rutas Camiones

Route::get('camiones', 'CamionController@index');

Route::post('camiones', 'CamionController@add');

Route::put('camiones', 'CamionController@edit');

Route::delete('camiones', 'CamionController@delete');

Route::post('camiones2', 'CamionController@get');

Route::post('camioneslist', 'CamionController@list');

Route::post('modal-camion-add', 'CamionController@modalAdd');

Route::post('modal-camion-edit', 'CamionController@modalEdit');

Route::post('modal-camion-ver', 'CamionController@modalVer');

//Rutas Cargas

Route::get('viaje/{viaje}/cargas', 'CargaController@index');

Route::post('viaje/{viaje}/cargas', 'CargaController@add');

Route::put('viaje/{viaje}/cargas', 'CargaController@edit');

Route::delete('viaje/{viaje}/cargas', 'CargaController@delete');

Route::post('viaje/{viaje}/modal-carga-add', 'CargaController@modalAdd');

Route::post('viaje/{viaje}/modal-carga-edit', 'CargaController@modalEdit');

Route::post('viaje/{viaje}/modal-carga-ver', 'CargaController@modalVer');

Route::post('viaje/{viaje}/cargaslist', 'CargaController@list');

//Rutas Usurios

Route::get('usuarios', 'UsuarioController@index');

Route::post('usuarios', 'UsuarioController@add');

Route::put('usuarios', 'UsuarioController@edit');

Route::delete('usuarios', 'UsuarioController@delete');

Route::post('modal-usuario-add', 'UsuarioController@modalAdd');

Route::post('modal-usuario-edit', 'UsuarioController@modalEdit');

Route::post('modal-usuario-ver', 'UsuarioController@modalVer');

Route::post('usuarioslist', 'UsuarioController@list');

//VIAJE ROUTE'S

Route::get('viaje', 'ViajeController@index');

Route::post('viaje', 'ViajeController@add');

Route::put('viaje', 'ViajeController@edit');

Route::delete('viaje', 'ViajeController@delete');

Route::post('viaje2', 'ViajeController@get');

Route::post('viajelist', 'ViajeController@list');

Route::post('modal-viaje-add', 'ViajeController@modalAdd');

Route::post('modal-viaje-edit', 'ViajeController@modalEdit');

Route::post('modal-viaje-ver', 'ViajeController@modalVer');

//LISTA DE COMUNAS 

Route::post('ver-comunas', 'CommuneController@comunas');

//Ruta Perfil

Route::get('perfil', 'PerfilController@index');

Route::post('perfil', 'PerfilController@get');

Route::put('perfil', 'PerfilController@edit');

Route::post('modal-perfil-edit', 'PerfilController@modalEdit');


//Lista Licitacion 


Route::get('licitaciones', 'LicitacionController@index');

Route::post('licitaciones', 'LicitacionController@add');

Route::put('licitaciones', 'LicitacionController@edit');

Route::delete('licitaciones', 'LicitacionController@delete');


Route::post('modal-licitacion-add', 'LicitacionController@modalAdd');

Route::post('modal-licitacion-edit', 'LicitacionController@modalEdit');

Route::post('modal-licitacion-ver', 'LicitacionController@modalVer');

Route::post('licitacioneslist', 'LicitacionController@list');


//Lista Costos 


Route::get('viaje/{viaje}/costos', 'CostoController@index');

Route::post('viaje/{viaje}/costos', 'CostoController@add');

Route::put('viaje/{viaje}/costos', 'CostoController@edit');

Route::delete('viaje/{viaje}/costos', 'CostoController@delete');


Route::post('viaje/{viaje}/modal-costo-add', 'CostoController@modalAdd');

Route::post('viaje/{viaje}/modal-costo-edit', 'CostoController@modalEdit');

Route::post('viaje/{viaje}/modal-costo-ver', 'CostoController@modalVer');

Route::post('viaje/{viaje}/costoslist', 'CostoController@list');

//Mis Viajes

Route::get('misViajes', 'ViajeCamioneroController@index');

Route::post('misViajes2', 'ViajeCamioneroController@get');

Route::post('misViajeslist', 'ViajeCamioneroController@list');

Route::post('modal-misViajes-ver', 'ViajeCamioneroController@modalVer');