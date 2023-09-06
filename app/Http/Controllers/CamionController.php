<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camion;
use App\Viaje;
use App\Http\Requests\RequestCamion;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CamionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        return view("camion.camion");
    }

    public function list(){
        $Camiones = Camion::all();
        return DataTables::of($Camiones)
        ->addColumn('accion', function (Camion $Camion) {
            return "
            <a href='#' onclick='ver(\"".$Camion['id']."\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Ver Camión'><i class='fas fa-bars'></i></a>
            <a href='#' onclick='editar(\"".$Camion['id']."\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Editar Camión'><i class='fas fa-edit'></i></a>
            <a href='#' onclick='eliminar(\"".$Camion['id']."\")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar Camión'><i class='fas fa-trash'></i></a>";
        })
        ->rawColumns(['accion'])
        ->toJson();
    }

    public function add(RequestCamion $request){
        $camion = new Camion();
        $camion->patente = $request->patente;
        $camion->marca = $request->marca;
        $camion->modelo = $request->modelo;
        $camion->anio = $request->anio;
        $camion->peso = $request->pesocam;
        $camion->pesomax = $request->pesomax;
        DB::beginTransaction();
        try{
            $camion->save();
            DB::commit();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');
    
        }
        catch(\Exception $e){
            DB::rollback();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al registrar los datos');
        }
        return response()->json($regreso);
    }

    public function edit(RequestCamion $request){
        $camion = Camion::where("id", $request->id)->first();
        
        if($camion){
            DB::beginTransaction();
            try{
                $camion->patente = $request->patente;
                $camion->marca = $request->marca;
                $camion->modelo = $request->modelo;
                $camion->anio = $request->anio;
                $camion->peso = $request->pesocam;
                $camion->pesomax = $request->pesomax;
                $camion->estado = $request->estado;
                $camion->save();
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
            $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');
        }

        return response()->json($regreso);
    }

    public function delete(Request $request){
        $viaje = Viaje::where("camion_id", $request->id)->first();
        if($viaje){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'No se puede eliminar un camión asignado a un viaje');

            return response()->json($regreso);
        }
        $camion = Camion::where("id", $request->id)->first();
        if($camion){
            DB::beginTransaction();
            try{
                $camion->delete();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Datos eliminados correctamente');
                DB::commit();
            }
            catch(\Exception $e){
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

    public function get(Request $request){
        $camion = Camion::where("id", $request->id)->first();
        if($camion){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'datos', $camion);

            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');

        return response()->json($regreso);
    }

    public function modalVer(Request $request){
        $id = $request->id;
        $idModal = $request->idModal;
        $Camion = Camion::where("id", $id)->first();

        return view('camion.ver-camion', compact('idModal', 'Camion'));
    }

    public function modalEdit(Request $request){
        $id = $request->id;
        $idModal = $request->idModal;
        $tipo = "edit";
        $Camion = Camion::where("id", $id)->first();

        return view('camion.form-camion', compact('idModal', 'Camion', 'tipo'));
    }

    public function modalAdd(Request $request){
        $idModal = $request->idModal;
        $tipo = "add";
        return view('camion.form-camion', compact('idModal', 'tipo'));
    }
}
