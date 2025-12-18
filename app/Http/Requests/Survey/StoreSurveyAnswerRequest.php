<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyAnswerRequest extends FormRequest
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
            'survey_id' => ['required', 'integer', 'exists:surveys,id'],
            'answers' => ['required', 'array', 'min:1'],
            'answers.*' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'survey_id.required' => 'L\'ID du sondage est requis.',
            'survey_id.exists' => 'Le sondage sélectionné n\'existe pas.',
            'answers.required' => 'Veuillez répondre aux questions.',
            'answers.min' => 'Veuillez répondre au moins à une question.',
            'answers.*.required' => 'Cette question est requise.',
        ];
    }
}
