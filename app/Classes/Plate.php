<?php namespace App\Classes;

use Log;
use App\User;
use Carbon\Carbon;
use App\Models\EventModel;
use Illuminate\Support\Facades\DB;

class Plate extends EST {
    
    public static function getListOfPlatesAndNamesForCarpark( $id, $carpark_id ) {
        
        $platesSingles = (array)DB::table('orders')
                ->join('order_details'          , 'order_details.order_id'     , '='   , 'orders.id')
                ->join('users'                  , 'users.id'                    , '='   , 'orders.user_id')
                ->join('single_tickets'         , 'single_tickets.id'           , '='   , 'order_details.single_ticket_id')
                ->join('products'               , 'products.id'                 , '='   , 'single_tickets.product_id')
                ->join('car_parks'              , 'products.car_park_id'        , '='   , 'car_parks.id')
                ->join('events'                 , 'events.id'                   , '='   , 'products.event_id')
                ->leftJoin('plates'             , 'plates.id'                   , '='   , 'order_details.plate_id')
                ->select('users.firstname', 'users.lastname', 'plates.plate_number')
                ->where('events.id', '=', $id)
                ->where('car_parks.id', '=', $carpark_id)
                ->distinct()
                ->orderBy('plate_number')
                ->orderBy('users.lastname')
                ->orderBy('users.firstname')
                ->get();
        
        $platesGuests = (array)DB::table('guests')
                ->join('guest_list_guests'      , 'guest_list_guests.guest_id'  , '='   , 'guests.id')
                ->join('guest_lists'            , 'guest_lists.id'              , '='   , 'guest_list_guests.guest_list_id')
                ->join('products'               , 'products.id'                 , '='   , 'guest_lists.product_id')
                ->join('car_parks'              , 'products.car_park_id'        , '='   , 'car_parks.id')
                ->join('events'                 , 'events.id'                   , '='   , 'products.event_id')
                ->leftJoin('plates'                 , 'plates.guest_id'             , '='   , 'guests.id')
                ->select('guests.firstname', 'guests.lastname', 'plates.plate_number')
                ->where('events.id', '=', $id)
                ->where('car_parks.id', '=', $carpark_id)
                ->distinct()
                ->orderBy('plate_number')
                ->orderBy('guests.lastname')
                ->orderBy('guests.firstname')
                ->get();
                              
/*
 * Leave multi tickets for now until we get to games - AH 25/May/2016.
        $platesMultiples = (array)DB::table('orders')
                ->join('order_details'          , 'order_details.order_id'     , '='   , 'orders.id')
                ->join('users'                  , 'users.id'                    , '='   , 'orders.user_id')
                ->join('multi_tickets'         , 'multi_tickets.id'           , '='   , 'order_details.multi_ticket_id')
                ->join('multi_ticket_groups' , 'multi_ticket_groups.id'   , '='   , 'multi_tickets.multi_ticket_group_id')
                ->join('multi_ticket_events' , 'multi_ticket_events.multi_ticket_group_id'    , '='   , 'multi_ticket_groups.id')
                ->join('plates'             , 'plates.id'                   , '='   , 'order_details.plate_id')
                ->select('users.firstname', 'users.lastname', 'plates.plate_number')
                ->where('multi_ticket_events.event_id', '=', $id)
                ->distinct()
                ->orderBy('plate_number')
                ->orderBy('users.lastname')
                ->orderBy('users.firstname')
                ->get();


 * 
 */        
        
        return array_merge( $platesSingles, $platesGuests );
        
    }
}
