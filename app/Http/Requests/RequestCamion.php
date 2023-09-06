<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCamion extends FormRequest
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
        if($this->request->has('id')){
            $id = $this->request->get('id');
            return [
                'patente' => 'required|max:7|min:7|string|unique:camions,patente,'.$id.',id',
                'anio' => 'required|min:1990|max:2022|numeric',
                'marca' => 'required|string|min:1|max:30',
                'modelo' => 'required|string|min:1|max:30',
                'pesocam'=> 'required|numeric|min:1|lt:pesomax',
                'pesomax'=> 'required|numeric|min:1',
                'estado' => 'integer|min:1|max:2'
            ];
        }
        else{
            return [
                'patente' => 'required|max:7|min:7|string|unique:camions,patente',
                'anio' => 'required|min:1990|max:2022|numeric',
                'marca' => 'required|string|min:1|max:30',
                'modelo' => 'required|string|min:1|max:30',
                'pesocam'=> 'required|numeric|min:1|lt:pesomax',
                'pesomax'=> 'required|numeric|min:1',
                'estado' => 'integer|min:1|max:2'
            ];
        }
        
    }
}
