<?php namespace App\Classes;

use Log;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Product extends EST {
    
    /**
     * Retruns car parks that a given customer has bought the tickets for. 
     *
     * @param INT $user_id
     * @param String $date
     * 
     * @return Array
     */
    public static function getProductsForACustomer( $user_id, $date = '' ) {
        
        $arrProducts = array();
        
        $Products = self::getSingleProductsForACustomer( $user_id, $date );
        foreach($Products as $Product) {
            $arrProducts[] = $Product;
        }
        $Products = self::getMultiProductsForACustomer( $user_id );
        foreach($Products as $Product) {
            $arrProducts[] = $Product;
        }
        
        return $arrProducts;
    }

    /**
     * Retruns car parks that a given customer has bought the single tickets for. 
     *
     * @param INT $user_id
     * @param String $date
     * 
     * @return Array
     */
    public static function getSingleProductsForACustomer( $user_id, $date = '' ) {
        
        $arrProducts = array();
        
        $Products_Single = (array)DB::table('orders')
                ->join('order_details'          , 'order_details.order_id'     , '='   , 'orders.id')
                ->join('single_tickets'         , 'single_tickets.id'           , '='   , 'order_details.single_ticket_id')
                ->join('products'               , 'products.id'                 , '='   , 'single_tickets.product_id')
                ->join('events'                 , 'events.id'                   , '='   , 'products.event_id')
                ->join('events_lang'            , 'events_lang.event_id'       , '='   , 'events.id')
                ->join('car_parks'              , 'car_parks.id'                , '='   , 'products.car_park_id')
                ->join('car_parks_lang'         , 'car_parks_lang.car_park_id' , '='   , 'car_parks.id')
                ->leftJoin('plates'                 , 'plates.id'                   , '='   , 'order_details.plate_id')
                ->select('products.*'
                        , 'car_parks.*'
                        , 'car_parks_lang.*'
                        , 'plates.plate_number'
                        , 'order_details.guid'
                        , 'events.*'
                        , 'order_details.price_paid'
                        , 'order_details.id as order_detail_id'
                        , 'order_details.status as order_details_status')
                ->where('orders.user_id', $user_id)
                ->where('events.date', '>=', Carbon::now()->format('Y-m-d'))
                ->where('order_details.single_ticket_id', '!=', 0)
                ->whereNotNull('order_details.single_ticket_id')
                ->get();

        foreach($Products_Single as $Product) {
            
            $refundAllowed = 0;
            
            if ( strtotime( $Product->date .' '. $Product->time ) > (time() + (_REFUND_BEFORE_IN_HRS_ * 60 * 60)) ) {
                $refundAllowed = 1;
            }
            
            $arrProducts[] = array(
                    'eventId' => $Product->event_id
                    , 'eventType' => _TICKET_TYPE_SINGLE_
                    , 'orderDetailsId' => $Product->order_detail_id
                    , 'productTitle' => $Product->name
                    , 'productStatus' => $Product->order_details_status
                    , 'productDescription' => $Product->description
                    , 'productDirections' => $Product->directions
                    , 'productOpeningTime' => $Product->opening_time
                    , 'productClosingTime' => $Product->closing_time
                    , 'productPrice'    => \App\Classes\Tools::penceToPound( $Product->price_paid )
                    , 'productLat'  => $Product->lat
                    , 'productLong' => $Product->long
                    , 'productPlate' => $Product->plate_number
                    , 'productToken' => $Product->guid
                    , 'productRefundAllowed' => $refundAllowed
                
            );                                   
        }
        
        return $arrProducts;
    }
    
    /**
     * Retruns car parks that a given customer has bought the season tickets for. 
     *
     * @param INT $user_id
     * @param String $date
     * 
     * @return Array
     */
    public static function getMultiProductsForACustomer( $user_id ) {
        
        $arrProducts = array();
        
        $Products_Multi = (array)DB::table('orders')
                ->join('order_details'          , 'order_details.order_id'     , '='   , 'orders.id')
                ->join('multi_tickets'           , 'multi_tickets.id'             , '='   , 'order_details.multi_ticket_id')
                ->join('car_parks'              , 'car_parks.id'                , '='   , 'multi_tickets.car_park_id')
                ->join('car_parks_lang'         , 'car_parks_lang.car_park_id' , '='   , 'car_parks.id')
                ->leftJoin('plates'                 , 'plates.id'                   , '='   , 'order_details.plate_id')
                ->select('multi_tickets.price as ticketPrice'
                        ,'car_parks.lat'
                        ,'car_parks.long'
                        ,'car_parks_lang.name as carParkName'
                        ,'car_parks_lang.description as carParkDescription'
                        ,'car_parks_lang.directions'
                        ,'plates.plate_number'
                        ,'multi_tickets.multi_ticket_group_id'
                        ,'order_details.guid'
                        ,'order_details.price_paid'
                        ,'order_details.id as order_detail_id'
                        ,'order_details.status as order_details_status')
                ->where('orders.user_id', $user_id)
                ->where('order_details.multi_ticket_id', '!=', 0)
                ->whereNotNull('order_details.multi_ticket_id')
                ->get();

        foreach($Products_Multi as $Product) {
            
            $refundAllowed = 0;
            
            $arrProducts[] = array(
                    'eventId' => $Product->multi_ticket_group_id
                    , 'eventType' => _TICKET_TYPE_MULTI_
                    , 'orderDetailsId' => $Product->order_detail_id
                    , 'productTitle' => $Product->carParkName
                    , 'productStatus' => $Product->order_details_status
                    , 'productDescription' => $Product->carParkDescription
                    , 'productPrice'    => \App\Classes\Tools::penceToPound( $Product->price_paid )
                    , 'productPlate' => $Product->plate_number
                    , 'productToken' => $Product->guid
                    , 'productLat'  => $Product->lat
                    , 'productLong' => $Product->long
                    , 'productRefundAllowed' => $refundAllowed
                
            );                                   
        }
        
        return $arrProducts;
    }
       
    /**
     * Retruns number of single tickets sold for a given product. 
     *
     * @param INT $product_id
     * 
     * @return INT
     */
    public static function numberOfSingleTicketsSoldForAProduct( $product_id, $status = _STATUS_ONLINE_ ) {
        
        if ( $status == _STATUS_ALL_ ) {
            
            $orders = DB::table('products')
                    ->join('single_tickets'     , 'single_tickets.product_id'   , '='   , 'products.id')
                    ->join('order_details'      , 'order_details.single_ticket_id' , '='   , 'single_tickets.id')
                    ->select('order_details.id')
                    ->where('order_details.status', _ORDER_STATUS_SUCCESSFUL_)
                    ->where('products.id', $product_id)
                    ->get();
            
        } else {
            
            $orders = DB::table('products')
                    ->join('single_tickets'     , 'single_tickets.product_id'   , '='   , 'products.id')
                    ->join('order_details'      , 'order_details.single_ticket_id' , '='   , 'single_tickets.id')
                    ->select('order_details.id')
                    ->where('products.status', $status)
                    ->where('order_details.status', _ORDER_STATUS_SUCCESSFUL_)
                    ->where('products.id', $product_id)
                    ->get();
            
        }
        
        return count($orders);
        
    }
    
    /**
     * Returns: 
     *  -> Event related data,  
     *  -> Teams, if relevant
     *  -> Car park data/stats for all the Products linked with given Event
     *
     * @param  \App\Model $Event
     * @return Array
     */
    public static function getCarParksDataForAnEvent( $Event ) {

        $arr_products = array();       

        $Products = $Event->products;
        
        foreach($Products as $Product) {
             
            $_Product = self::getProductDataForAProduct( $Product );
            if ( count($_Product) ) {
                $arr_products[] = $_Product;
            }        
        }

        return $arr_products;
    }
    
    /**
     * Returns data and stats related to a single car park for a given Product object 
     *
     * @param  \App\Model $Product
     * @return Array
     */
    public static function getProductDataForAProduct( $Product ) {

        $CarPark = $Product->carpark;
        
        if ( !$CarPark ) {
            return array();
        }
        
        return array(
             'carParkId'                => $CarPark->id    
            , 'productId'               => $Product->id
            , 'carParkName'             => $CarPark->lang->name
            , 'capacity'                => $CarPark->capacity
            , 'priority'                => $CarPark->priority
            , 'allocated'               => $Product->allocated
            , 'price'                   => $Product->singleTicket->getPriceInDecimal(false)
            , 'openingTime'             => $Product->opening_time
            , 'closingTime'             => $Product->closing_time
            , 'status'                  => $Product->status
            , 'guestListSpaces'         => count( $Product->guestLists )
            , 'multiTicketsSold'        => CarPark::numberOfMultiTicketsSoldForACarPark( $CarPark->id )
            , 'multiTicketsCheckedIn'   => CarPark::numberOfMultiTicketsCheckedInForACarPark( $CarPark->id, $Product->event_id )
            , 'singleTicketsSold'       => self::numberOfSingleTicketsSoldForAProduct( $Product->id, _STATUS_ALL_ )
            , 'guestListCheckedIn'      => self::numberOfGuestsCheckedInForAProduct( $Product->id, _STATUS_ALL_ )
            , 'wastedSpaces'            => self::numberOfWastedSpacesForAProduct( $Product->id, _STATUS_ALL_ )
        );
    }

    /**
     * Returns data/stats for all car parks linked with the given event, if event exists. 
     *
     * @return Array
     */
    public static function getAllProductsForAnEvent( $Event ) {
        
        if ( $Event ) {

            return self::getCarParksDataForAnEvent( $Event );
            
        }
    }
             
    /**
     * Retruns number of confirmed guests for a given product 
     *
     * @param INT $product_id
     * 
     * @return INT
     */
    public static function numberOfGuestsCheckedInForAProduct( $product_id, $status = _STATUS_ONLINE_ ) {

        if ( $status == _STATUS_ALL_ ) {
            
            $guestsCheckedIn = (array)DB::table('products')
                    ->join('guest_lists'     , 'guest_lists.product_id'   , '='   , 'products.id')
                    ->join('guest_list_guests'  , 'guest_list_guests.guest_list_id', '=' , 'guest_lists.id')
                    ->selectRaw('SUM(guest_list_guests.checked_in) as guestsCheckedIn')
                    ->where('products.id', $product_id)
                    ->first();
            
        } else {
            
            $guestsCheckedIn = (array)DB::table('products')
                    ->join('guest_lists'     , 'guest_lists.product_id'   , '='   , 'products.id')
                    ->join('guest_list_guests'  , 'guest_list_guests.guest_list_id', '=' , 'guest_lists.id')
                    ->selectRaw('SUM(guest_list_guests.checked_in) as guestsCheckedIn')
                    ->where('products.status', $status)
                    ->where('products.id', $product_id)
                    ->first();
            
        }   
        
        return (INT)$guestsCheckedIn['guestsCheckedIn'];
    }
    
    /**
     * Retruns number of wasted spaces for a given product 
     *
     * @param INT $product_id
     * 
     * @return INT
     */
    public static function numberOfWastedSpacesForAProduct( $product_id, $status = _STATUS_ONLINE_ ) {
        
        if ( $status == _STATUS_ALL_ ) {
            
            $wastedSpaces = (array)DB::table('products')
                    ->join('wastages'     , 'wastages.product_id'   , '='   , 'products.id')
                    ->selectRaw('SUM(spaces) as wastedSpaces')
                    ->where('products.id', $product_id)
                    ->first();
        } else {
            
            $wastedSpaces = (array)DB::table('products')
                    ->join('wastages'     , 'wastages.product_id'   , '='   , 'products.id')
                    ->selectRaw('SUM(spaces) as wastedSpaces')
                    ->where('products.status', $status)
                    ->where('products.id', $product_id)
                    ->first();
        }
        
        return (INT)$wastedSpaces['wastedSpaces'];
    }
        
    /**
     * Retruns an array of formated data for a given Product object, for front end.
     *
     * @param App\Models\ProductModel $Product
     * 
     * @return Array
     */
    public static function formatDataFromAProductForFrontEnd( $Product ) {
        
            $arrProduct = array();
            $arrProduct['productId'] = $Product->id;
            
            //
            // Calculate availability
            $numberSold = self::numberOfSingleTicketsSoldForAProduct( $Product->id );
            // Increase number sold by one to avoid overbooking
            $numberSold++;
            $pecentage = (INT)Tools::calculate_percentage( $numberSold, $Product->allocated );            

            if ( $numberSold >= $Product->allocated ) {  
                $arrProduct['capacity_status'] = _CARPARK_SOLD_TEXT_;
            } elseif ( $pecentage >= _CARPARK_LIMITED_FIGURE_ ) {
                $arrProduct['capacity_status'] = _CARPARK_LIMITED_TEXT_;
            } else {
               $arrProduct['capacity_status'] = _CARPARK_AVAILABLE_TEXT_;                            
            }
            
            //
            // Car Park details
            $arrProduct['carparkName'] =           $Product->carpark->lang->name;
            $arrProduct['carparkDescription'] =    $Product->carpark->lang->description;
            $arrProduct['openingTime'] =           $Product->opening_time;
            $arrProduct['closingTime'] =           $Product->closing_time;
            $arrProduct['carparkLat'] =            $Product->carpark->lat;
            $arrProduct['carparkLong'] =           $Product->carpark->long;            
            $arrProduct['price'] =                 $Product->singleTicket->price;
            $arrProduct['ticketId'] =               $Product->singleTicket->id;
            
            return $arrProduct;
    }
        
}