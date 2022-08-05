<?php

namespace App\Models;

use App\Classes\Tools;
use App\Models\EstModel;

class SingleTicketModel extends EstModel
{
    protected $table = 'single_tickets';
    
    public function getpriceAttribute($value) {

        return Tools::penceToPound($value);
        
    }
    
    public function getPriceInDecimal($with_currency_sign = false) {
        if ( $with_currency_sign ) {
            return sprintf('£%0.2f', $this->price);
        } else {
            return sprintf('%0.2f', $this->price);
        }
    }
    
    public function Product() {
        
        return $this->belongsTo('App\Models\ProductModel' ,'product_id');
        
    }
}
