<?php

namespace App\Http\Requests\Organization;

use App\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrganization extends FormRequest
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
            'name' => ['required', 'min:3', 'max:30', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de l\'organisation doit être obligatoire',
            'name.min' => 'Le nom de l\'organisation doit avoir un minimum de 3 caractères',
            'name.max' => 'Le nom de l\'organisation doit avoir un maximum de 30 caractères',
        ];
    }
}
