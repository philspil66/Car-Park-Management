<?php

namespace App\Models;
use App\Models\EstModel;

use Illuminate\Database\Eloquent\Model;

class CarParkModel extends EstModel
{
    protected $table = 'car_parks';

    public function lang() {
    	
        return $this->hasOne('App\Models\CarParkLangModel', 'car_park_id', 'id');
    }

}
