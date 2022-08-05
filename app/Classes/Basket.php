<?php namespace App\Classes;

use App\Models\MultiTicketModel;
use App\Models\SingleTicketModel;

class Basket extends EST {
    

    /**
     * Returns the basket 
     *
     * @return Array
     */
    public static function getBasket() {
        
        return SessionBasket::getBasket();
    }
    
    /**
     * Returns number of items in the basket 
     *
     * @return INT
     */
    public static function getNumberOfItems() {
        
        $basket = self::getBasket();
        return ( array_has($basket, 'count') ? (INT)$basket['count'] : 0 );
    }
    
    /**
     * Returns total value of the basket 
     *
     * @return Decimals
     */
    public static function getBasketTotalValue() {
        
        $basket = self::getBasket();
        return ( array_has($basket, 'total') ? $basket['total'] : 0 );
        
    }
    
    /**
     * Returns total value of the basket in pence
     *
     * @return INT
     */
    public static function getBasketTotalValueAsPence() {
        
        $total = self::getBasketTotalValue();
        return (INT)($total * 100);
        
    }
    
    /**
     * Returns TRUE if baskets exists and has at least 1 item in it, otherwise FALSE 
     *
     * @return BOOL
     */
    public static function basketExists() {
        
        return (BOOL)self::getNumberOfItems();
        
    }
    
    /**
     * Discards the basket from the session 
     *
     * @return BOOL
     */
    public static function discardBasket() {
        
        SessionBasket::forgetBasket();
        
    }
    
    /**
     * Returns season tickets data formatted for basket view 
     *
     * @param Array $tickets tickets details
     * @return Array
     */
    public static function formatMultiTicketDataForView( $tickets ) {
        
        $arrTickets = array();
        
        foreach($tickets as $ticket) {
            
            $arrTicket = array();
            $Ticket = MultiTicketModel::find( $ticket['id'] );
            $retTicket = MultiTicket::formatMultiticketDetailsForBasketView($Ticket);
            for($i=0; $i<$ticket['qty']; $i++) {
                $arrTickets[] = $retTicket;
            }
            
        }        
        
        //
        // Reformat the data suitable for basket design/requirements, ie
        // showing multiple bookings under one event.
        $arrReformatted = array();
        foreach($arrTickets as $arrTicket) {
            
            if (!array_key_exists($arrTicket['multiTicketGroupId'], $arrReformatted)) {
                $arrReformatted[$arrTicket['multiTicketGroupId']] = array(
                    'multiTicketGroupName' => $arrTicket['multiTicketGroupName'] 
                    );
            }                
            $arrReformatted[$arrTicket['multiTicketGroupId']]['tickets'][] = $arrTicket;
            
        }

        return $arrReformatted;
    }
    
    /**
     * Returns single tickets data formatted for basket view 
     *
     * @param Array $tickets tickets details
     * @return Array
     */
    public static function formatSingleTicketDataForView( $tickets ) {
        
        $arrTickets = array();
        
        foreach($tickets as $ticket) {
            
            $arrTicket = array();
            $Ticket = SingleTicketModel::find( $ticket['id'] );
            $retTicket = SingleTicket::formatSingleticketDetailsForBasketView($Ticket);
            for($i=0; $i<$ticket['qty']; $i++) {
                $arrTickets[] = $retTicket;
            }
            
        }
        
        //
        // Reformat the data suitable for basket design/requirements, ie
        // showing multiple bookings under one event.
        $arrReformatted = array();
        foreach($arrTickets as $arrTicket) {            
            
            if (!array_key_exists($arrTicket['eventId'], $arrReformatted)) {
                $arrReformatted[$arrTicket['eventId']] = array(
                    'eventTitle' => $arrTicket['eventTitle'] 
                    , 'eventDate' => $arrTicket['eventDate']
                    , 'eventTime' => $arrTicket['eventTime']
                    , 'teamOneLogo' => $arrTicket['teamOneLogo']
                    , 'teamTwoLogo' => $arrTicket['teamTwoLogo']
                    , 'teamOneName' => $arrTicket['teamOneName']
                    , 'teamTwoName' => $arrTicket['teamTwoName']
                    );
            }                
            $arrReformatted[$arrTicket['eventId']]['tickets'][] = $arrTicket;
            
        }
        
        return $arrReformatted;
    }
    
    /**
     * Removes one season ticket from the basket with the given id 
     *
     * @param INT $id ticket id to be removed
     * @return Array
     */
    public static function removeMulti( $id ) {
        
        $seasonTickets = self::getTicketsFromBasket( _TICKET_TYPE_MULTI_ );
        $arrReturn = array();
        
        foreach($seasonTickets as $key => $seasonTicket) {
            
            if ( $key == $id) {
                $qty = $seasonTicket['qty'] - 1;
                if ( $qty > 0 ) {
                    $seasonTicket['qty'] = $qty;
                    $arrReturn[$key] = $seasonTicket;
                }
            } else {
                $arrReturn[$key] = $seasonTicket;
            }
        
        }
        
        $basket = self::putTicketsInBasket(_TICKET_TYPE_MULTI_, $arrReturn);
        self::updateBasketCountTotal($basket);        
        
    }
    
    /**
     * Removes one season ticket from the basket with the given id 
     *
     * @param INT $id ticket id to be removed
     * @return Array
     */
    public static function removeSingle( $id ) {
        
        $singleTickets = self::getTicketsFromBasket( _TICKET_TYPE_SINGLE_ );
        $arrReturn = array();
        
        foreach($singleTickets as $key => $singleTicket) {
            
            if ( $key == $id) {
                $qty = $singleTicket['qty'] - 1;
                if ( $qty > 0 ) {
                    $singleTicket['qty'] = $qty;
                    $arrReturn[$key] = $singleTicket;
                }
            } else {
                $arrReturn[$key] = $singleTicket;
            }
        
        }
        
        $basket = self::putTicketsInBasket(_TICKET_TYPE_SINGLE_, $arrReturn);
        self::updateBasketCountTotal($basket);        
        
    }
        
    /**
     * Puts a season ticket in the basket 
     *
     * @param  INT $id
     * @return void
     */
    public static function addMulti( $id, $quantity = 1 ) {
        
        //
        // Get Ticket object
        $MultiTicket = MultiTicketModel::find( $id );

        //
        // Get existing season tickets array already saved in the basket, if any
        $seasonTickets = self::getTicketsFromBasket( _TICKET_TYPE_MULTI_ );
        
        //
        // If matchiing carpark id exists in the basket then simply increase the quantity
        // otherwise insert a new season ticket
        if (array_key_exists($id, $seasonTickets)) {
            // Update qty
            $seasonTickets[$id]['qty'] = (INT)$seasonTickets[$id]['qty'] + $quantity;
        } else {
            // Add a new ticket
            $seasonTickets[$id] = array( 'id' => $id, 'qty' => $quantity, 'price' => $MultiTicket->price );
        }
        
        //
        // Put season tickets array back in the basket
        $basket = self::putTicketsInBasket(_TICKET_TYPE_MULTI_, $seasonTickets);
        
        //
        // Update basket total value and number of items
        $basket = self::updateBasketCountTotal($basket);
        
        //
        // Put the basket back into the session
        SessionBasket::setBasket( $basket );

    }
    
    /**
     * Puts a single ticket in the basket 
     *
     * @param  INT $id
     * @return void
     */
    public static function addSingle( $id, $quantity = 1 ) {
        
        $SingleTicket = SingleTicketModel::find( $id );
        $singleTickets = self::getTicketsFromBasket( _TICKET_TYPE_SINGLE_ );
        
        if (array_key_exists($id, $singleTickets)) {
            $singleTickets[$id]['qty'] = (INT)$singleTickets[$id]['qty'] + $quantity;
        } else {
            $singleTickets[$id] = array( 'id' => $id, 'qty' => $quantity, 'price' => $SingleTicket->price );
        }
        
        $basket = self::putTicketsInBasket(_TICKET_TYPE_SINGLE_, $singleTickets);
        $basket = self::updateBasketCountTotal($basket);
        SessionBasket::setBasket( $basket );
        
    }
    
    /**
     * Get tickets array from the basket 
     *
     * @return Array $basket | empty
     */
    public static function getTicketsFromBasket( $type ) {
        
        //
        // Get season tickets basket array, return empty array if basket array is empty
        $basket = self::getBasket();
        if ( !(BOOL)count($basket) ) {
            return array();
        }
        
        
        if (array_key_exists( trim($type), $basket )) {
        //
        // If multi tickets key exists in the Basket

            return $basket[ trim($type) ];


        } else {
        //
        // No multi tickets key exists in the Basket   

            return array();
        }
        
    }
    
    /**
     * Saves tickets array back in the basket. 
     *
     * @param  Array $seasonTickets - array of season tickets
     * @return Array $basket
     */
    private static function putTicketsInBasket( $type, $tickets = array() ) {
        
        $type = trim($type);
        $basket = self::getBasket();
        
        if ( strlen( trim($type) ) == 0 ) {
            return $basket;
        }
        
        $basket[$type] = $tickets;
        SessionBasket::setBasket( $basket );

        return $basket;
    }
    
    /**
     * Updates total value and number of items in the basket. 
     *
     * @param  Array $basket
     * @return Array $basket
     */
    private static function updateBasketCountTotal( $basket ) {
            
        $total = 0;
        $count = 0;            

        if (array_key_exists(_TICKET_TYPE_MULTI_, $basket)) {
            foreach( $basket[_TICKET_TYPE_MULTI_] as $key => $ticket ) {

                $total += $ticket['price'] * (INT)$ticket['qty'];
                $count += (INT)$ticket['qty'];
            }
        }
        
        if (array_key_exists(_TICKET_TYPE_SINGLE_, $basket)) {
            foreach( $basket[_TICKET_TYPE_SINGLE_] as $key => $ticket ) {

                $total += $ticket['price'] * (INT)$ticket['qty'];
                $count += (INT)$ticket['qty'];
            }
        }
        
        $basket['total'] = $total;
        $basket['count'] = $count;
        SessionBasket::setBasket( $basket );

        return $basket;
    }
    
}