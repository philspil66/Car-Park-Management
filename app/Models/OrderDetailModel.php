<?php

namespace App\Models;

use App\Models\EstModel;
use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends EstModel
{
    protected $table = 'order_details';
    
    public function Product() {
        return $this->belongsTo('App\Models\ProductModel', 'product_id', 'id');
    }

    public function Order() {
        return $this->belongsTo('App\Models\OrderModel', 'order_id', 'id');
    }
    
    public function singleTicket() {
        return $this->belongsTo('App\Models\SingleTicketModel', 'single_ticket_id');        
    }
    
    public function multiTicket() {
        return $this->belongsTo('App\Models\MultiTicketModel', 'multi_ticket_id');        
    }
    
    public function Plate() {
        return $this->belongsTo('App\Models\PlateModel', 'plate_id');
    }
}
