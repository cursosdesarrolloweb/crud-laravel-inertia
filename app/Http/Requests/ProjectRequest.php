<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique(table: 'projects', column: 'name')->ignore(id: request('project'), idColumn: 'id'),
            ],
            'description' => 'required|string|max:1000',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('El campo nombre es obligatorio.'),
            'name.string' => __('El campo nombre debe ser una cadena de texto.'),
            'name.max' => __('El campo nombre no debe ser mayor a :max caracteres.'),
            'name.unique' => __('El campo nombre ya está en uso.'),
            'description.required' => __('El campo descripción es obligatorio.'),
            'description.string' => __('El campo descripción debe ser una cadena de texto.'),
            'description.max' => __('El campo descripción no debe ser mayor a :max caracteres.'),
        ];
    }
}
