<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;

final class StoreOrganizationAction
{
    public function __construct() {}

    /**
     * Store an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): Organization
    {
<<<<<<< Updated upstream
        $organisation = Organization::create([
            'name' => $dto->name,
            'user_id' => $dto->user_id
        ]);

        return $organisation;
=======

        $organization = Organization::create([
            'name'=> $dto->name,
            'user_id'=> $dto->user_id,
        ]);

        return $organization;
>>>>>>> Stashed changes
    }
}
