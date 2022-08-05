<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{

	protected $table = 'roles'; 
    	
    public function lang() {

        return $this->hasOne('App\Models\RoleLangModel', 'role_id');   

    }
}
