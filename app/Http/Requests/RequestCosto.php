<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCosto extends FormRequest
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
            'costos_nombre' => 'required|max:30|min:1|string',
            'costos_costo'=> 'required|numeric|min:1',
            'costos_cantidad'=> 'required|numeric|min:1'
        ];
    }
}
