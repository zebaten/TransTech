<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function comunas(Request $request)
    {
        $comunas = \App\Commune::where('region_id', $request->id)->get();
        return $comunas->toJson();
    }
}
