<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Http\Requests\Survey\StoreSurveyQuestionRequest;

final class SurveyQuestionDTO
{
    private function __construct(
        public readonly int $survey_id,
        public readonly string $title,
        public readonly string $question_type,
        public readonly ?array $options,
    ) {}

    public static function fromRequest(StoreSurveyQuestionRequest $request): self
    {

        $type = $request->question_type;
        $options = [];

        if($type === 'scale')
        {
            $options = range(1, 10);
        } elseif ($type === 'radio' || $type === 'checkbox')
        {
            $options = explode("\n", $request->options ?? '');
            $options = array_map('trim', $options);
            $options = array_filter($options);
        }

        $options = $options ?? [];

        return new self(
            survey_id: $request->survey_id,
            title: $request->title,
            question_type: $request->question_type,
            options: array_values($options),
        );
    }
}
