<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Viaje;
use App\Http\Requests\RequestViaje;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViajeCamioneroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("miviaje.viaje");
    }

    public function list()
    {
        $Viajes = Viaje::where('usuarios_rut', Auth::user()->usuarios_rut)->get();
        return DataTables::of($Viajes)
            ->addColumn('accion', function (Viaje $viaje) {
                return "
            <a href='#' onclick='ver(\"" . $viaje['id'] . "\")' class='btn btn-sm btn-outline-secondary m-1 px-3' title='Ver'><i class='fas fa-bars'></i></a>";
            })
            ->addColumn('costo', function (Viaje $viaje) {
                return "
                <a href='./viaje/" . $viaje['id'] . "/costos' class='btn btn-sm btn-outline-success m-1 px-3' title='Ver'><i class='fas fa-bars'></i></a>";
            })
            ->addColumn('carga', function (Viaje $viaje) {
                return "
                <a href='./viaje/" . $viaje['id'] . "/cargas' class='btn btn-sm btn-outline-primary m-1 px-3' title='Ver'><i class='fas fa-bars'></i></a>";
            })
            ->rawColumns(['accion', 'costo', 'carga'])
            ->toJson();
    }

    public function add(RequestViaje $request)
    {
        $viaje = new Viaje();
        $viaje->usuarios_rut = $request->usuarios_rut;
        $viaje->viaje_inicio = $request->viaje_inicio;
        $viaje->viaje_lugar_inicio = $request->viaje_lugar_inicio;
        $viaje->viaje_destino = $request->viaje_destino;
        $viaje->viaje_fecha = $request->viaje_fecha;
        $viaje->comuna_cod = $request->comuna_cod;
        $viaje->carga_cod = $request->carga_cod;
        $viaje->lic_cod = $request->lic_cod;
        $viaje->costos_cod = $request->costos_cod;
        DB::beginTransaction();
        try {
            $viaje->save();
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

    public function edit(RequestViaje $request)
    {
        $viaje = Viaje::where("id", $request->id)->first();

        if ($viaje) {
            DB::beginTransaction();
            try {
                $viaje->usuarios_rut = $request->usuarios_rut;
                $viaje->viaje_inicio = $request->viaje_inicio;
                $viaje->viaje_lugar_inicio = $request->viaje_lugar_inicio;
                $viaje->viaje_destino = $request->viaje_destino;
                $viaje->viaje_fecha = $request->viaje_fecha;
                $viaje->comuna_cod = $request->comuna_cod;
                $viaje->carga_cod = $request->carga_cod;
                $viaje->lic_cod = $request->lic_cod;
                $viaje->costos_cod = $request->costos_cod;
                $viaje->save();
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

    public function delete(Request $request)
    {
        $viaje = Viaje::where("id", $request->id)->first();
        if ($viaje) {
            DB::beginTransaction();
            try {
                $viaje->delete();
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
        $viaje = Viaje::where("id", $request->id)->first();
        if ($viaje) {
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'datos', $viaje);

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
        $regiones = \App\Region::all();
        $Viaje = Viaje::where("id", $id)->first();
        $camion = \App\Camion::where("id", $Viaje->camion_id)->first();
        $usuario = \App\Usuarios::where("id", $Viaje->usuarios_rut)->first();
        $comuna = \App\Commune::where("id", $Viaje->comuna_cod)->first();
        $region = \App\Region::where("id", $comuna->region_id)->first();
        $comunainicio = \App\Commune::where("id", $Viaje->comuna_inicio_cod)->first();
        $regioninicio = \App\Region::where("id", $comunainicio->region_id)->first();
        $licitacion = \App\Licitacion::where("id", $Viaje->lic_cod)->first();
        $costos = \App\Costo::where("viaje_id", $Viaje->id)->get();
        $costoTotal = 0;
        foreach ($costos as $costo) {
            $costoTotal += $costo->costos_costo * $costo->costos_cantidad;
        }
        $cargas = \App\Carga::where("viaje_id", $Viaje->id)->get();
        $pesoTotal = 0;
        foreach ($cargas as $carga) {
            $pesoTotal += $carga->peso * $carga->cantidad;
        }


        return view('viaje.ver-viaje', compact(
            'idModal',
            'Viaje',
            'regiones',
            'usuario',
            'comuna',
            'region',
            'licitacion',
            'costoTotal',
            'pesoTotal',
            'comunainicio',
            'regioninicio',
            'camion'
        ));
    }
}
