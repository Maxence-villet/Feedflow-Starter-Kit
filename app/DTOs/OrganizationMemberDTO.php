<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use App\Http\Requests\OrganizationUser\StoreOrganizationUser;

final class OrganizationMemberDTO
{
    private function __construct(
        public readonly int $user_id,
        public readonly string $role,
        public readonly int $organization_id,
    ) {}

    public static function fromRequest(StoreOrganizationUser $request): self
    {
        return new self(
            user_id: $request->user_id,
            role: $request->role,
            organization_id: $request->route('organization')->id
        );
    }
}
