<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use App\Rules\Recaptcha;

class RequestAjaxStorePista extends FormRequest
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
            'nombre' => ['required','string','max:100','min:5'],
            'audio' => 'required|file|max:100000',
            'foto' => 'required|file|max:5000',
            'hermano_id' => 'required|exists:hermanos,id',
            'g-recaptcha-response' => 'required',
        ];
    }
}
