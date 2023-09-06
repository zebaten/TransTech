<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCarga extends FormRequest
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
            'nombre' => 'required|string|min:1|max:50',
            'peso' => 'required|numeric|min:1',
            'tipo' => 'required|string|min:1|max:40',
            'cantidad' => 'required|numeric|min:1'
        ];
    }
}
