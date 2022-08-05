<?php

namespace App\Models;

use App\Classes\Tools;
use App\Models\EstModel;

use Illuminate\Database\Eloquent\Model;

class MultiTicketModel extends EstModel
{
    protected $table = 'multi_tickets';

    public function getpriceAttribute($value) {

        return Tools::penceToPound($value);
                
    }
    
    //public function lang() {

        //return $this->hasOne('App\Models\MultiTicketLangModel', 'multi_ticket_id', 'id');
    //}
    
    public function getOpeningTimeAttribute($value) {
        
        return date('H:i', strtotime($value) );
        
    }
    public function getClosingTimeAttribute($value) {
        
        return date('H:i', strtotime($value) );
        
    }
    
    public function carpark() {

        return $this->belongsTo('App\Models\CarParkModel', 'car_park_id', 'id');
    }
    
    public function multiTicketGroup() {

        return $this->belongsTo('App\Models\MultiTicketGroupModel', 'multi_ticket_group_id', 'id');
    }
    
}
