<?php

namespace App\DTOs;

use App\Http\Requests\Organization\StoreOrganization;
use Illuminate\Http\Request;

final class OrganizationDTO
{
    private function __construct(
        public readonly string $name,
        public readonly int $user_id,
    ) {}

    public static function fromRequest(StoreOrganization $request): self
    {
        return new self(
            name: $request->name,
<<<<<<< Updated upstream
            user_id: $request->user()->id,
=======
            user_id: $request->user()->id
>>>>>>> Stashed changes
        );
    }
}
