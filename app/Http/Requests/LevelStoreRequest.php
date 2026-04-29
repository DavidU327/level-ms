<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LevelStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:levels,name',
            'max_point' => 'required|integer',
            'min_point' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'El nivel "' . $this->name . '" ya existe.',
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede superar los 100 caracteres.',
            'max_point.required' => 'El campo max_point es obligatorio.',
            'max_point.integer' => 'El campo max_point debe ser un número entero.',
            'min_point.required' => 'El campo min_point es obligatorio.',
            'min_point.integer' => 'El campo min_point debe ser un número entero.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Error de validación',
                'errors'  => $validator->errors(),
                'code'    => 422,
            ], 422)
        );
    }
}
