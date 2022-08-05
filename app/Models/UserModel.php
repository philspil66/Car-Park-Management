<?php

namespace App\Models;
use App\Models\EstModel;

use Illuminate\Database\Eloquent\Model;

class UserModel extends EstModel
{
    protected $table = 'users';

    /**
     *   usersAnd
     *   myFunction Definition
     * @returns    array            Returns Definition
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public function role()
    {
        // relate roles
        return $this->hasOne('App\Models\RoleModel','role_id','id');
    }

    /**
     *   usersAddresses
     *   Returns addresses owned by the user
     * @param
     * @returns    object
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public function addresses()
    {
        //relate addresses
        return $this->hasOne('App\Models\AddressModel','address_id','id');
    }
}
