<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Usuarios;
use App\Http\Requests\RequestPerfil;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $Usuario = Usuarios::where('id', Auth::id())->with(['commune'=>function($query){
            $query->with('region');
        }])->first();
        $regiones = \App\Region::all();
        return view("perfil.perfil", compact('Usuario', 'regiones'));
    }

    public function get(){
        $Usuario = Usuarios::where('id', Auth::id())->with(['commune'=>function($query){
            $query->with('region');
        }])->first();
        $regiones = \App\Region::all();
        return view("perfil.ver-perfil", compact('Usuario', 'regiones'));
    }

    public function edit(RequestPerfil $request){
        $usuario = Usuarios::where("id", Auth::id())->first();
        
        if($usuario){
            DB::beginTransaction();
            try{
                if($usuario->password != ""){
                    $usuario->password = Hash::make($request->password);
                }
                $usuario->usuarios_nombre = $request->usuarios_nombre;
                $usuario->usuarios_telefono = $request->usuarios_telefono;
                $usuario->usuarios_correo = $request->usuarios_correo;
                $usuario->usuarios_direccion = $request->usuarios_direccion;
                $usuario->usuarios_fncto = $request->usuarios_fncto;
                $usuario->usuarios_vacuna = $request->usuarios_vacuna;
                $usuario->comuna_cod = $request->comuna_cod;
                $usuario->save();
                DB::commit();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');
            }
            catch(\Exception $e){
                DB::rollback();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al editar los datos');
            }
        }
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Registro no encotrado');
        }

        return response()->json($regreso);
    }

    public function modalEdit(Request $request){
        $regiones = \App\Region::all();         
        $id = $request->id;
        $idModal = $request->idModal;
        $tipo = "edit";
        $Usuario = Usuarios::where('id', Auth::id())->with(['commune'=>function($query){
            $query->with('region');
        }])->first();

        return view('perfil.form-perfil', compact('idModal', 'Usuario', 'tipo', 'regiones'));
    }
}
