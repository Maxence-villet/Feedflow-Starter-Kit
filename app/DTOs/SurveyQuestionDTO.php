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
        $options = null;

        if(in_array($options, ['radio', 'checkbox', 'scale']))
        {
            if($request->question_type === 'scale')
            {
                $options = [];
                for($i=1;i<=10; $i++)
                {
                    $options[] = (string)$i;
                }
            } elseif($request->has('options') && !empty($request->options)) {
                $options = array_filter(array_map('trim', explode("\n", $request->options)));
            }
        }

        $options = $options ?? [];

        return new self(
            survey_id: $request->survey_id,
            title: $request->title,
            question_type: $request->question_type,
            options: $options,
        );
    }
}
