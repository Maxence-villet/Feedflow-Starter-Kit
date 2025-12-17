<?php

namespace App\Http\Requests\Survey;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurveyQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
            'title' => ['required', 'string', 'max:500'],
            'question_type' => ['required', 'string', 'in:text,radio,checkbox,scale'],
            'options' => ['nullable', 'string', 'required_if:question_type,radio,checkbox'],
        ];
    }

    public function message()
    {
        return [
            'survey_id.required' => 'Le sondage est requis',
            'survey_id.exists' => 'Le sondage sélectionné n\'existe pas',
            'title.required' => 'Le titre de la question est requis',
            'title.max' => 'Le titre ne doit pas dépasser 500 caractères',
            'question_type.required' => 'Le type de question est requis',
            'question_type.in' => 'Le type de question doit être texte, radio, checkbox ou scale',
            'options.required_if' => 'Les options sont requises pour ce type de question',
        ];
    }
}
