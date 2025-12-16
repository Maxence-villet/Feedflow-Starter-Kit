<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class OrganizationDTO
{
    private function __construct(
        public readonly string $name,
        public readonly int $user_id,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            user_id: $request->user()->id,
        );
    }
}
