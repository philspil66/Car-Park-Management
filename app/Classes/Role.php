<?php
/**
 * Created by PhpStorm.
 * User: keni
 * Date: 7/4/2016
 * Time: 2:10 PM
 */

namespace App\Classes;

use Log;
use App\Models\RoleModel;
use App\Models\RoleLangModel;

use Illuminate\Support\Facades\DB;

class Role extends EST
{
    /**
     *   getAllRoles
     *   Lists all roles with names from RoleLangModel
     * @param
     * @returns    object      $roles      Roles with role name from language table
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public static function getAllRoles()
    {
        $roles = DB::table('roles')
            ->leftjoin('roles_lang', 'roles_lang.role_id', '=', 'roles.id')
            ->orderby('roles_lang.name')
            ->selectRaw(<<<ROLES
roles.id,
roles_lang.name as role
ROLES
            );
        return $roles->get();
    }
}