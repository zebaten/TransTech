<?php

namespace App\Http\Controllers;

use App\Carga;
use App\Viaje;
use App\Http\Requests\RequestCarga;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($viaje)
    {
        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            abort(404);
        }

        return view("carga.carga", compact('viaje'));
    }

    public function list($viaje)
    {
        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al validar al usuario');
            return response()->json($regreso);
        }
        $Cargas = Carga::where('viaje_id', $viaje->id)->get();
        return DataTables::of($Cargas)
            ->addColumn('accion', function (Carga $Carga) {
                return "
            <a href='#' onclick='ver(\"" . $Carga['id'] . "\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Ver'><i class='fas fa-bars'></i></a>
            <a href='#' onclick='editar(\"" . $Carga['id'] . "\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Editar'><i class='fas fa-edit'></i></a>
            <a href='#' onclick='eliminar(\"" . $Carga['id'] . "\")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fas fa-trash'></i></a>";
            })
            ->rawColumns(['accion'])
            ->toJson();
    }

    public function add(RequestCarga $request, $viaje)
    {
        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al validar al usuario');
            return response()->json($regreso);
        }
        $carga = new Carga();
        $carga->nombre = $request->nombre;
        $carga->peso = $request->peso;
        $carga->tipo = $request->tipo;
        $carga->cantidad = $request->cantidad;
        $carga->viaje_id = $viaje->id;
        $cargas = \App\Carga::where("viaje_id", $viaje->id)->get();
        $pesoTotal = 0;
        $camion = \App\Camion::where("id", $viaje->camion_id)->first();
        foreach ($cargas as $c) {
            $pesoTotal += $c->peso * $c->cantidad;
        }
        if ($pesoTotal + $carga->cantidad * $carga->peso > $camion->pesomax) {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al registrar los datos, peso ingresado supera el peso máximo del camión');
            return response()->json($regreso);
        }
        DB::beginTransaction();
        try {
            $carga->save();
            DB::commit();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al registrar los datos');
        }
        return response()->json($regreso);
    }

    public function edit(RequestCarga $request, $viaje)
    {
        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al validar al usuario');
            return response()->json($regreso);
        }
        $carga = Carga::where("id", $request->id)->where('viaje_id', $viaje->id)->first();
        $cargaant = Carga::where("id", $request->id)->where('viaje_id', $viaje->id)->first();
        if ($carga) {
            DB::beginTransaction();
            try {
                $carga->nombre = $request->nombre;
                $carga->peso = $request->peso;
                $carga->tipo = $request->tipo;
                $carga->cantidad = $request->cantidad;
                $cargas = \App\Carga::where("viaje_id", $viaje->id)->get();
                $pesoTotal = 0;
                $camion = \App\Camion::where("id", $viaje->camion_id)->first();
                foreach ($cargas as $c) {
                    $pesoTotal += $c->peso * $c->cantidad;
                }
                if ($pesoTotal - $cargaant->cantidad * $cargaant->peso + $carga->cantidad * $carga->peso > $camion->pesomax) {
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'Error al registrar los datos, peso ingresado supera el peso máximo del camión');
                    return response()->json($regreso);
                }
                $carga->save();
                DB::commit();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');
            } catch (\Exception $e) {
                DB::rollback();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al editar los datos');
            }
        } else {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Registro no encotrado');
        }

        return response()->json($regreso);
    }

    public function delete(Request $request, $viaje)
    {
        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al validar al usuario');
            return response()->json($regreso);
        }
        $carga = Carga::where("id", $request->id)->where('viaje_id', $viaje->id)->first();
        if ($carga) {
            DB::beginTransaction();
            try {
                $carga->delete();
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
        $carga = Carga::where("id", $request->id)->first();
        if ($carga) {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'datos', $carga);

            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');

        return response()->json($regreso);
    }

    public function modalVer(Request $request)
    {
        $id = $request->id;
        $idModal = $request->idModal;
        $Carga = Carga::where("id", $id)->first();

        return view('carga.ver-carga', compact('idModal', 'Carga'));
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $idModal = $request->idModal;
        $tipo = "edit";
        $Carga = Carga::where("id", $id)->first();

        return view('carga.form-carga', compact('idModal', 'Carga', 'tipo'));
    }

    public function modalAdd(Request $request)
    {
        $idModal = $request->idModal;
        $tipo = "add";
        return view('carga.form-carga', compact('idModal', 'tipo'));
    }
}
