<?php
namespace App\Actions\Survey;

use App\DTOs\SurveyDTO;
use Illuminate\Support\Facades\DB;
use App\Models\Survey;

final class StoreSurveyAction
{
    public function __construct() {}

    /**
     * Store a Survey
     * @param SurveyDTO $dto
     * @return Survey
     */
    public function handle(SurveyDTO $dto): Survey
    {
        $survey = Survey::create([
            'organization_id' => $dto->organization_id,
            'user_id' => $dto->user_id,
            'title' => $dto->title,
            'description' => $dto->description,
            'start_date' => $dto->start_date,
            'end_date' => $dto->end_date,
            'is_anonymous' => $dto->is_anonymous
        ]);

        return $survey;
    }
}
