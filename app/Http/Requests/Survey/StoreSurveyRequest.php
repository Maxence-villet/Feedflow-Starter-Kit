<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1024'],
            'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d'],
            'is_anonymous' => ['bool'],
        ];
    }

    public function messsages(): array
    {
        return [
            'title.required' => 'Le titre doit être requie',
            'title.max' => 'Le titre doit contenir moins de 255 caractères',
            'description.required' => 'La description doit être requie',
            'description.max' => 'La description doit contenir moins de 1024 caractères',
            'start_date.required' => 'La date de début doit être requie',
            'start_date.date_format' => 'Veuillez entrer la date de début au format JJ/MM/AAAA',
            'end_date.required' => 'La date de fin doit être requie',
            'end_date.date_format' => 'Veuillez entrer la date de début au format JJ/MM/AAAA',
        ];
    }
}
