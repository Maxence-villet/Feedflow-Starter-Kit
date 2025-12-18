<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyAnswerDTO;
use Illuminate\Support\Facades\DB;
use App\Models\SurveyAnswer;

final class StoreSurveyAnswerAction
{
    public function __construct() {}

    /**
     * Store a Survey
     * @param SurveyDTO $dto
     * @return array
     */
    public function handle(SurveyAnswerDTO $dto): SurveyAnswer
    {
        $answer = SurveyAnswer::create([
            'survey_id' => $dto->survey_id,
            'survey_question_id' => $dto->survey_question_id,
            'user_id' => $dto->user_id,
            'answer' => $dto->answer,
        ])
    }
}
