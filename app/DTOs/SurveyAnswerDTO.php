<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Http\Requests\Survey\StoreSurveyAnswerRequest;

final class SurveyAnswerDTO
{
    private function __construct(
        public readonly int $survey_id,
        public readonly ?int $user_id,
        public readonly array $answers, 
    ) {}

    public static function fromRequest(StoreSurveyAnswerRequest $request): self
    {
        return new self(
            survey_id: $request->survey_id,
            user_id: auth()->check() ? auth()->user()->id : null,
            answers: $request->answers,
        );
    }
}
