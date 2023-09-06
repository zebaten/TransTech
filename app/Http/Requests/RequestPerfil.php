<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RequestPerfil extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'usuarios_nombre' => 'required|min:1|max:255|string',
            'usuarios_correo' => 'required|email:rfc,dns|min:1|max:30|unique:usuarios,usuarios_correo,'.Auth::id().',id',
            'usuarios_telefono' => 'required|numeric|min:900000000|max:999999999',
            'usuarios_direccion'=> 'required|string|min:1|max:255',
            'usuarios_fncto'=> 'required|date',
            'comuna_cod' => 'required|exists:App\Commune,id'
        ];
    }
}
