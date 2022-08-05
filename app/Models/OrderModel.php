<?php

namespace App\Models;

use App\Models\EstModel;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends EstModel
{
    protected $table = 'orders';
        
    public function OrderDetails() {
        return $this->hasMany('App\Models\OrderDetailModel', 'order_id');
    }
    
    public function Address() {
        return $this->hasOne('App\Models\AddressModel', 'id', 'address_id');
    }
    
    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
