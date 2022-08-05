<?php

namespace App\Models;

use App\Models\EstModel;

class WastageReasonModel extends EstModel
{
    protected $table = 'wastage_reasons';
    
    public function lang() {    	
        return $this->hasOne('App\Models\WastageReasonLangModel', 'wastage_reason_id', 'id');
    }
}
