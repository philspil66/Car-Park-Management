<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\EstController;
use App\Models\ProductModel;
use App\Models\EventModel;
use App\Models\CarParkModel;
use App\Classes\Basket;
use App\Classes\MultiTicket;

class BasketController extends EstController
{

    public $product_row = array();

    
    
    /**
     * Returns all tickets stored in the basket 
     *
     * @return Array
     */
    public function getAll() {

        $basket = Basket::getBasket();

        $multi = array();
        $single = array();
        
        foreach($basket as $type => $details) {
  
            if ( $type == _TICKET_TYPE_MULTI_ ) {
                
                $multi = Basket::formatMultiTicketDataForView($details);
                
            }
            
            if ( $type == _TICKET_TYPE_SINGLE_ ) {
                
                $single = Basket::formatSingleTicketDataForView($details);
                
            }
            
        }
        
        $items = Basket::getNumberOfItems();
        $total = Basket::getBasketTotalValue();
        
        return view('site.basket.basket', compact('single', 'multi', 'total', 'items'));
    }

    /**
     * Given season ticket id, this method puts it in the basket and redirects to basket page. 
     *
     * @param INT $ticketId
     * @return void
     */
    public function addMulti($ticketId) {
        
        $basket = Basket::addMulti($ticketId);
        return redirect('/basket');
        
    }

    /**
     * Given single ticket id, this method puts it in the basket and redirects to basket page. 
     *
     * @param INT $ticketId
     * @return void
     */
    public function addSingle($ticketId) { 

        $basket = Basket::addSingle($ticketId);
        return redirect('/basket');
        
    }
    
    /**
     * Given season ticket id, this method removes it from the basket and redirects to basket page. 
     *
     * @param INT $ticketId
     * @return void
     */
    public function removeMulti($ticketId) {

        Basket::removeMulti($ticketId);        
        return redirect('/basket');
        
    }

    /**
     * Given single ticket id, this method removes it from the basket and redirects to basket page. 
     *
     * @param INT $ticketId
     * @return void
     */
    public function removeSingle($ticketId) {

        Basket::removeSingle($ticketId);        
        return redirect('/basket');
        
    }
    
}
