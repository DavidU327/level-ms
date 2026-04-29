<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LevelUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $levelId = $this->route('level');
        return [
            'name' => 'sometimes|required|string|max:100|unique:levels,name,' . $levelId,
            'max_point' => 'sometimes|required|integer',
            'min_point' => 'sometimes|required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'El nivel "' . $this->name . '" ya existe.',
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no puede superar los 100 caracteres.',
            'max_point.integer' => 'El campo max_point debe ser un número entero.',
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
