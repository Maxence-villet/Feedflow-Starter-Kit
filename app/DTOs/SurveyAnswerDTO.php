<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class SurveyAnswerDTO
{
    private function __construct(
        public readonly int $survey_id,
        public readonly int $survey_question_id,
        public readonly int $user_id,
        public readonly string $answer, 
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            survey_id: $request->survey_id,
            survey_question_id: $request->survey_question_id,
            user_id: $request->auth()->user() ? $request->auth()->user()->id : null,
            answer: $request->answser,
        );
    }
}
