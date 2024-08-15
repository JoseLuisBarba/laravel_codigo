<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServicioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'titulo' => 'required',
            'category_id' => [
                'requiered', 'exists::categories,id'
            ],
            'descripcion' => 'required',
            'image' => [ $this->route('servicio') ? 'nullable' : 'required','mimes:png,jpg']
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Se necesita un título para el servicio',
            'category_id.required' => 'Seleccione una categoria para el servicio',
            'descripcion.required' => 'Ingreso una descripción, es necesario',
            'image.required' => 'Debes seleccionar una imagen'
        ];
    }
}
