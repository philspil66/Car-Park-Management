<?php namespace App\Classes;

use Session;

class SessionBasket extends EST {

    /*
     ******   Structure of Basket in the Session
     * 
     * Session['basket'] => array(
     *                          ['total'] => 0.00
     *                          , ['count'] => 0
     *                          , ['multi'] => array (
     *                                                  array( ['ticket'] => multi_ticket_object, ['qty'] => multi_ticket_quantity)                 
     *                                                  , array( ['ticket'] => multi_ticket_object, ['qty'] => multi_ticket_quantity)                 
     *                                                  , array( ['ticket'] => multi_ticket_object, ['qty'] => multi_ticket_quantity)                 
     *                                             )
     *                          , ['single'] => array (
     *                                                  array( ['ticket'] => single_ticket_object, ['qty'] => single_ticket_quantity)                 
     *                                                  , array( ['ticket'] => single_ticket_object, ['qty'] => single_ticket_quantity)                 
     *                                                  , array( ['ticket'] => single_ticket_object, ['qty'] => single_ticket_quantity)                 
     *                                                  
     *                                              )
     *                      )      
     *      */
    
        
    
    /**
     * Returns basket array from the session. 
     *
     * @return Array 
     */
    public static function getBasket() {
        
        if ( Session::has( _BASKET_TEXT_ ) ) {
        //    
        // If Basket exists
            
            return Session::get( _BASKET_TEXT_ );
        } else {
            
            return array();
        }
        
    }

    /**
     * Saves basket array from the session. 
     *
     * @return void 
     */
    public static function setBasket( $basket ) {
        
        Session::set(_BASKET_TEXT_, $basket);
        
    }
    
    /**
     * Destroys basket array from the session. 
     *
     * @return void 
     */
    public static function forgetBasket() {
        
        if ( Session::has( _BASKET_TEXT_ ) ) {
            Session::forget( _BASKET_TEXT_ );
        }
        
    }
    
}