<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\DTOs\OrganizationMemberDTO;
use Illuminate\Support\Facades\DB;
use App\Models\OrganizationUser;

final class StoreOrganizationMemberAction
{
    public function __construct() {}

    /**
     * Store an organization
     * @param OrganizationMemberDTO $dto
     * @return array
     * @throws \Throwable
     */
    public function handle(OrganizationMemberDTO $dto): OrganizationUser
    {
        $organisationMember = OrganizationUser::create([
            'user_id' => $dto->user_id,
            'organization_id' => $dto->organization_id,
            'role' => $dto->role,
        ]);

        return $organisationMember;
    }
}
