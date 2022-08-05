<?php namespace App\Classes;

use Validator;
use Illuminate\Support\Facades\DB;

class eTicket extends EST {
    
    /**
     * Retruns eTicket data for a season ticket for the given token. 
     *
     * @param String $token
     * 
     * @return Array
     */
    public static function getETicketForMultiTicket( $token ) {
        
        $eTicket =  (array)DB::table('order_details')
            ->join('orders'         , 'order_id'               , '=', 'orders.id')
            ->join('users'          , 'user_id'                , '=', 'users.id')
            ->join('plates'         , 'order_details.plate_id'                , '=', 'plates.id')
            ->join('multi_tickets'          , 'order_details.multi_ticket_id'    , '='   , 'multi_tickets.id')
            ->join('multi_ticket_groups'    , 'multi_ticket_groups.id'      , '='   , 'multi_tickets.multi_ticket_group_id')
            ->join('multi_ticket_groups_lang'   , 'multi_ticket_groups.id'  , '='   , 'multi_ticket_groups_lang.multi_ticket_group_id')
            ->select('multi_ticket_groups_lang.*', 'multi_ticket_groups_lang.name as title', 'plates.plate_number', 'orders.order_ref', 'order_details.multi_ticket_id')
            ->where('order_details.guid', $token)
            ->first();
        
        return $eTicket;
    }
    
    /**
     * Retruns eTicket data for a single ticket for the given token. 
     *
     * @param String $token
     * 
     * @return Array
     */
    public static function getETicketForSingleTicket( $token ) {
        
        $eTicket =  (array)DB::table('order_details')
            ->join('orders'         , 'order_id'               , '=', 'orders.id')
            ->join('users'          , 'user_id'                , '=', 'users.id')
            ->join('plates'         , 'order_details.plate_id'                , '=', 'plates.id')
            ->join('single_tickets' , 'order_details.single_ticket_id'             ,'='    , 'single_tickets.id')
            ->join('products'       , 'single_tickets.product_id'             , '=', 'products.id')
            ->join('events'         , 'products.event_id'      , '=', 'events.id')
            ->join('events_lang'    , 'events.id'               , '=', 'events_lang.event_id')
            ->join('car_parks'      , 'products.car_park_id'   , '=', 'car_parks.id')
            ->join('car_parks_lang' , 'car_parks.id'            , '=', 'car_parks_lang.car_park_id')
            ->leftJoin('teams as team1', 'team1.id', '=', 'events.team1_id')
            ->leftJoin('teams as team2', 'team2.id', '=', 'events.team2_id')
            ->select('car_parks_lang.*'
                    , 'car_parks_lang.name as carpark_name'
                    , 'products.*'
                    , 'team1.logo as team1logo'
                    , 'team2.logo as team2logo'
                    , 'plates.plate_number'
                    , 'events.date as event_date'
                    , 'events_lang.title as title'
                    , 'orders.order_ref')
            ->where('order_details.guid', $token)
            ->first();

        $eTicket['event_date'] = strtotime($eTicket['event_date']);
        if ( checkdate( date("n", $eTicket['event_date']), date("j", $eTicket['event_date']), date("Y", $eTicket['event_date']) ) ) {
            $eTicket['event_date'] = date("D jS M Y", $eTicket['event_date']);
        } else {
            $eTicket['event_date'] = "";                
        }  
        
        return $eTicket;        
    }
    
}