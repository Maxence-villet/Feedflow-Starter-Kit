<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyAnswerDTO;
use Illuminate\Support\Facades\DB;
use App\Models\SurveyAnswer;
use App\Models\Survey;
use App\Events\SurveyAnswerSubmitted;

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
        $survey = Survey::find($dto->survey_id);
        if ($survey->notification) {
            event(new SurveyAnswerSubmitted($survey, $dto->user_id));
        }

        $survey->total_daily_answers = $survey->total_daily_answers + 1;
        $survey->save();
        return $answers;     
    }
}
