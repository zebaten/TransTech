<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Usuarios;
use App\Viaje;
use App\Http\Requests\RequestUsuario;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view("usuario.usuario");
    }

    public function list()
    {
        $Usuarios = Usuarios::all();
        return DataTables::of($Usuarios)
            ->addColumn('accion', function (Usuarios $Usuario) {
                return "
            <a href='#' onclick='ver(\"" . $Usuario['id'] . "\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Ver'><i class='fas fa-bars'></i></a>
            <a href='#' onclick='editar(\"" . $Usuario['id'] . "\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Editar'><i class='fas fa-edit'></i></a>
            <a href='#' onclick='eliminar(\"" . $Usuario['id'] . "\")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fas fa-trash'></i></a>";
            })
            ->rawColumns(['accion'])
            ->toJson();
    }

    public function add(RequestUsuario $request)
    {
        if (Auth::user()->rol_cod != 1) {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Usted no cuenta con los privilegios de Administrador');
            return response()->json($regreso);
        }
        $usuario = new Usuarios();
        $usuario->usuarios_rut = $request->usuarios_rut;
        $usuario->password = Hash::make($request->password);
        $usuario->usuarios_nombre = $request->usuarios_nombre;
        $usuario->usuarios_telefono = $request->usuarios_telefono;
        $usuario->usuarios_correo = $request->usuarios_correo;
        $usuario->usuarios_direccion = $request->usuarios_direccion;
        $usuario->usuarios_fncto = $request->usuarios_fncto;
        $usuario->usuarios_vacuna = $request->usuarios_vacuna;
        $usuario->comuna_cod = $request->comuna_cod;
        $usuario->rol_cod = $request->rol_cod;
        DB::beginTransaction();
        try {
            $usuario->save();
            DB::commit();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al registrar los datos');
        }
        return response()->json($regreso);
    }

    public function edit(RequestUsuario $request)
    {
        $usuario = Usuarios::where("id", $request->id)->first();

        if ($usuario) {
            DB::beginTransaction();
            try {
                $usuario->usuarios_rut = $request->usuarios_rut;
                if ($request->password != "") {
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
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al editar los datos');
            }
        } else {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');
        }

        return response()->json($regreso);
    }

    public function delete(Request $request)
    {
        
        if ($request->id == Auth::id()) {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'No puedes eliminarte a ti mismo');

            return response()->json($regreso);
        }
        $usuario = Usuarios::where("id", $request->id)->first();
        $viaje = Viaje::where('usuarios_rut', $usuario->usuarios_rut)->first();
        if($viaje){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'No se puede eliminar un usuario asociado a un viaje');
    
            return response()->json($regreso);
        }
        if ($usuario) {
            DB::beginTransaction();
            try {
                $usuario->delete();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Datos eliminados correctamente');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al eliminar los datos');
            }
            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');

        return response()->json($regreso);
    }

    public function get(Request $request)
    {
        $usuario = Usuarios::where("id", $request->id)->first();
        if ($usuario) {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'datos', $usuario);

            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');

        return response()->json($regreso);
    }

    public function modalVer(Request $request)
    {
        $regiones = \App\Region::all();
        $id = $request->id;
        $idModal = $request->idModal;
        $Usuario = Usuarios::where("id", $id)->first();

        return view('usuario.ver-usuario', compact('idModal', 'Usuario', 'regiones'));
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $regiones = \App\Region::all();


        $idModal = $request->idModal;
        $tipo = "edit";
        $Usuario = Usuarios::where("id", $id)->first();
        $comunas = \App\Commune::where("id", $Usuario->comuna_cod)->first();
        $region = \App\Region::where("id", $comunas->region_id)->first();
        return view('usuario.form-usuario', compact('idModal', 'Usuario', 'tipo', 'regiones', 'comunas'));
    }

    public function modalAdd(Request $request)
    {
        $regiones = \App\Region::all();
        $idModal = $request->idModal;
        $tipo = "add";
        return view('usuario.form-usuario', compact('idModal', 'tipo', 'regiones'));
    }
}
