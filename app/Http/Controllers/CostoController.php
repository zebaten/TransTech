<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Costo;
use App\Viaje;
use App\Http\Requests\RequestCosto;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CostoController extends Controller
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
 
        return view("Costo.costo", compact('viaje'));
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
        $Costos = Costo::where('viaje_id', $viaje->id)->get();
        return DataTables::of($Costos)
            ->addColumn('accion', function (Costo $Costo) {
                return "
            <a href='#' onclick='ver(\"" . $Costo['id'] . "\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Ver Costo'><i class='fas fa-bars'></i></a>
            <a href='#' onclick='editar(\"" . $Costo['id'] . "\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Editar Costo'><i class='fas fa-edit'></i></a>
            <a href='#' onclick='eliminar(\"" . $Costo['id'] . "\")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar Costo'><i class='fas fa-trash'></i></a>";
            })
            ->rawColumns(['accion'])
            ->toJson();
    }

    public function add(RequestCosto $request, $viaje)
    {
        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al validar al usuario');
            return response()->json($regreso);
        }
        $costo = new Costo();
        $costo->costos_nombre = $request->costos_nombre;
        $costo->costos_costo = $request->costos_costo;
        $costo->costos_cantidad = $request->costos_cantidad;
        $costo->viaje_id = $viaje->id;
        DB::beginTransaction();
        try {
            $costo->save();
            DB::commit();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al registrar los datos');
        }
        return response()->json($regreso);
    }

    public function edit(RequestCosto $request, $viaje)
    {
        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al validar al usuario');
            return response()->json($regreso);
        }
        $costo = costo::where("id", $request->id)->where("viaje_id", $viaje->id)->first();

        if ($costo) {
            DB::beginTransaction();
            try {
                $costo->costos_nombre = $request->costos_nombre;
                $costo->costos_costo = $request->costos_costo;
                $costo->costos_cantidad = $request->costos_cantidad;
                $costo->save();
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
            $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');
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
        $costo = costo::where("id", $request->id)->where("viaje_id", $viaje->id)->first();
        if ($costo) {
            DB::beginTransaction();
            try {
                $costo->delete();
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
        $costo = costo::where("id", $request->id)->first();
        if ($costo) {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'datos', $costo);

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
        $costo = costo::where("id", $id)->first();

        return view('Costo.ver-costo', compact('idModal', 'costo'));
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $idModal = $request->idModal;
        $tipo = "edit";
        $costo = costo::where("id", $id)->first();

        return view('Costo.form-costo', compact('idModal', 'costo', 'tipo'));
    }

    public function modalAdd(Request $request)
    {
        $idModal = $request->idModal;
        $tipo = "add";
        return view('Costo.form-costo', compact('idModal', 'tipo'));
    }
}
