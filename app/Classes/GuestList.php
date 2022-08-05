<?php namespace App\Classes;

use App\Models\CarParkModel;
use Illuminate\Support\Facades\DB;

class GuestList extends EST {

     /**
     * Given an event id, this method returns data for temporary web app for checking in cars.
     * Only for single events for now. 
     *
     * @param  INT $eventId
     * @return Array
     */
    public static function getGuestsForAnEvent( $eventId ) {
        
        $data = (array)DB::table('products')
                ->join('guest_lists' ,'guest_lists.product_id', '=', 'products.id')
                ->join('guest_list_guests'  ,'guest_list_guests.guest_list_id',  '=',    'guest_lists.id')
                ->join('guests'  ,'guests.id',    '=',    'guest_list_guests.guest_id')
                ->join('car_parks', 'car_parks.id', '=',    'products.car_park_id')
                ->leftjoin('plates',    'plates.guest_id',  '=',   'guests.id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('products.event_id' , $eventId)
                ->select('car_parks.sku', 'guests.firstname', 'guests.lastname', 'plates.plate_number')
                ->get();

        $retData = array();
        foreach($data as $row) {
            $retData[] = array(
                      'pn' =>       str_replace('null', '', $row->plate_number)
                    , 'pc' =>       ''
                    , 'or' =>       ''
                    , 'fn' =>       trim($row->firstname.' '.$row->lastname)
                    , 'cp' =>       str_replace('null', '', $row->sku)
            );
        }
        
        return $retData;
    }
}