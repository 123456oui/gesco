<?php

namespace App\Http\Requests\Params;

use Illuminate\Foundation\Http\FormRequest;

class NiveauformRequest extends FormRequest
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
            'libelleniveau'=>['required','unique:niveaux','min:2'],
            'annee'=>['required','min:2'],
            'Montantscolarite'=>['required','numeric'],

            //
        ];
    }
}
