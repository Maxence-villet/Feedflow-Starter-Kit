<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $organization = Organization::create([
            'name' => $dto->name,
            'user_id' => $dto->user_id
        ]);

        $user = auth()->user();
        $user->organization_id = $organization->id;
        $user->save();

        Auth::setUser($user);

        return $organization;
    }
}
