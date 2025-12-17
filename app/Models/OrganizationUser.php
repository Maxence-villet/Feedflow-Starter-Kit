<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationUser extends Model
{
    use HasFactory;

    protected $table    = 'organization_user';
    public $timestamps  = true;
    protected $fillable = [ 'id', 'user_id', 'organization_id', 'role', 'created_at', 'updated_at' ];
    protected $casts = [
    ];

    public static function getOrganizationUsers($organizationId) {
        return self::leftJoin('users', 'organization_user.user_id', '=', 'users.id')
                        ->where('organization_user.organization_id', $organizationId)
                        ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'organization_user.role')
                        ->get();
    }
}
