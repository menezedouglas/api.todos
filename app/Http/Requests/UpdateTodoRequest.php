<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric|exists:todos',
            'title' => 'required|min:5|string',
            'description' => 'required|min:10|string',
            'fixed' => 'required|boolean'
        ];
    }

    /**
     * Determine response errors attributes
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'id' => 'Identificador',
            'title' => 'Título',
            'description' => 'Descrição',
            'fixed' => 'Fixado'
        ];
    }

    /**
     * Errors detected are returned
     *
     * @param Validator $validator
     * @return JsonResponse
     */
    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
