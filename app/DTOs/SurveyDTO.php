<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Http\Requests\Survey\StoreSurveyRequest;
use App\Http\Requests\Survey\UpdateSurveyRequest;
final class SurveyDTO
{
    private function __construct(
        public readonly int $organization_id,
        public readonly int $user_id,
        public readonly string $title,
        public readonly string $description,
        public readonly string $start_date,
        public readonly string $end_date,
        public readonly bool $is_anonymous,
    ) {}

    public static function fromRequest(StoreSurveyRequest|UpdateSurveyRequest $request): self
    {

        $isAnonymous = $request->has('is_anonymous')
            ? filter_var($request->is_anonymous, FILTER_VALIDATE_BOOLEAN)
            : false;
        
        return new self(
            organization_id: 1,
            user_id: auth()->user()->id,
            title: $request->title,
            description: $request->description,
            start_date: $request->start_date,
            end_date: $request->end_date,
            is_anonymous: $isAnonymous,
        );
    }
}
