<?php

namespace App\Models;
use App\Models\EstModel;
use App\Classes\Tools;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends EstModel
{
    protected $table = 'products';
    protected $fillable = array('id');
    
    public function getpriceAttribute($value) {

        return Tools::penceToPound($value);
        
    }
    
    public function getOpeningTimeAttribute($value) {
        
        return date('H:i', strtotime($value) );
        
    }
    public function getClosingTimeAttribute($value) {
        
        return date('H:i', strtotime($value) );
        
    }
    
    public function carpark() {

        return $this->belongsTo('App\Models\CarParkModel', 'car_park_id', 'id');
    }

    public function event() {

        return $this->belongsTo('App\Models\EventModel', 'event_id', 'id');
    }

//    public function guestLists() {
//        return $this->hasMany('App\Models\GuestList', 'product_id', 'id');
//    }
    
    public function singleTicket() {
        return $this->hasOne('App\Models\SingleTicketModel', 'product_id', 'id');
    }

}
