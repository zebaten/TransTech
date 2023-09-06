<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestLicitacion extends FormRequest
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
            'lic_nombre' => 'required|string|min:1|max:255',
            'lic_valor' => 'required|numeric|min:1 ',
            'lic_empresa' => 'required|string|min:1|max:255', 
            'lic_rut' => 'required|string|min:1|max:10', 
        ];
    }
}
