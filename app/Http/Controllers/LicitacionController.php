<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Viaje;
use Illuminate\Http\Request;
use App\Licitacion;
use App\Http\Requests\RequestLicitacion;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class LicitacionController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        return view("licitacion.licitacion");
    }

    public function list(){
        $licitacion = licitacion::all();
        return DataTables::of($licitacion)
        ->addColumn('accion', function (licitacion $licitacion) {
            return "
            <a href='#' onclick='ver(\"".$licitacion['id']."\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Editar'><i class='fas fa-bars'></i></a>
            <a href='#' onclick='editar(\"".$licitacion['id']."\")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Editar'><i class='fas fa-edit'></i></a>
            <a href='#' onclick='eliminar(\"".$licitacion['id']."\")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fas fa-trash'></i></a>";
        })
        ->rawColumns(['accion'])
        ->toJson();
    }

    public function add(Requestlicitacion $request){
        $licitacion = new licitacion();
        $licitacion->lic_nombre = $request->lic_nombre;
        $licitacion->lic_valor = $request->lic_valor;
        $licitacion->lic_empresa = $request->lic_empresa;
        $licitacion->lic_rut = $request->lic_rut;
        DB::beginTransaction();
        try{
            $licitacion->save();
            DB::commit();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');

        }
        catch(\Exception $e){
            dd($e);
            DB::rollback();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al registrar los datos');
        }
        return response()->json($regreso);
    }

    public function edit(RequestLicitacion $request){
        $licitacion = licitacion::where("id", $request->id)->first();

        if($licitacion){
            DB::beginTransaction();
            try{
                $licitacion->lic_nombre = $request->lic_nombre;
                $licitacion->lic_valor = $request->lic_valor;
                $licitacion->lic_empresa = $request->lic_empresa;
                $licitacion->lic_rut = $request->lic_rut;
                $licitacion->save();
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

    public function delete(Request $request){

        $viaje = Viaje::where('id', $viaje)->first();
        if($viaje->usuarios_rut != Auth::user()->usuarios_rut && Auth::user()->rol_cod != 1){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Registro no encontrado');
            return response()->json($regreso);

        }
        $licitacion = Licitacion::where("id", $request->id)->first();
        if($licitacion){
            DB::beginTransaction();
            try{
                $licitacion->delete();
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
        $licitacion = licitacion::where("id", $request->id)->first();
        if($licitacion){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'datos', $licitacion);

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
        $licitacion = Licitacion::where("id", $id)->first();

        return view('licitacion.ver-licitacion', compact('idModal', 'licitacion'));
    }

    public function modalEdit(Request $request){
        $id = $request->id;
        $idModal = $request->idModal;
        $tipo = "edit";
        $licitacion = licitacion::where("id", $id)->first();

        return view('licitacion.form-licitacion', compact('idModal', 'licitacion', 'tipo'));
    }

    public function modalAdd(Request $request){
        $idModal = $request->idModal;
        $tipo = "add";
        return view('licitacion.form-licitacion', compact('idModal', 'tipo'));
    }
}