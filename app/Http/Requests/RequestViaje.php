<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestViaje extends FormRequest
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
            'viaje_inicio' => 'required',
            'viaje_destino' => 'required|string|min:1|max:30',
            'viaje_fecha' => 'required',
            'comuna_cod' => 'required|numeric|min:1',
        ];
    }
}
