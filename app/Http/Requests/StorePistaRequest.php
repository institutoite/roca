<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePistaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:100','min:10'],
            'audio' => 'required|string|max:50000', // El campo audio debe ser una cadena de máximo 100 caracteres
            'foto' => 'required|string|max:5000', // El campo foto debe ser una cadena de máximo 100 caracteres
            'hermano_id' => 'required|exists:hermanos,id', // El campo he
        ];
    }
}

