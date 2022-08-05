<?php

namespace App\Models;
use App\Models\EstModel;

use Illuminate\Database\Eloquent\Model;

class MultiTicketGroupModel extends EstModel
{
    protected $table = 'multi_ticket_groups';

    public function lang() {

        return $this->hasOne('App\Models\MultiTicketGroupLangModel', 'multi_ticket_group_id', 'id');
    }
    
    public function Tickets() {
        return $this->hasMany('App\Models\MultiticketModel');
    }

}
