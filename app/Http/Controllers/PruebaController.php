<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prueba;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;

class PruebaController extends Controller
{
    //
    public function index(){
        return view('prueba');
    }

    public function add(Request $request){
        $prueba = new Prueba();
        $prueba->nombre = $request->nombre;
        $prueba->correo = $request->correo;
        $prueba->save();

        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'true');
        $regreso = Arr::add($regreso, 'mensaje', 'Datos guardados correctamente');

        return response()->json($regreso);
    }

    public function list(){
        $pruebas = Prueba::all();
        return DataTables::of($pruebas)
        ->addColumn('accion', function (Prueba $prueba) {
            return "<a href='#' onclick='eliminar(".$prueba['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fas fa-trash'></i></a>";
        })
        ->rawColumns(['accion'])
        ->toJson();
    }

    public function delete(Request $request){
        $prueba = Prueba::findOrFail($request->id);
        if($prueba){
            $prueba->delete();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Datos eliminados correctamente');

            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Error al borrar los datos');

        return response()->json($regreso);
    }
}
