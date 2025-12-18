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
    public function handle(SurveyAnswerDTO $dto): Array
    {
        
        $answers= [];
        $timestamp = now();

        foreach($dto->answers as $questionId => $answerValue)
        {
            $answers[] = [
                'survey_id' => $dto->survey_id,
                'survey_question_id' => $questionId,
                'user_id' => $dto->user_id,
                'answer' => $answerValue,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }
        $answersInserted = SurveyAnswer::insert($answers);
        dd($answersInserted);
        return $answers;     
    }
}
