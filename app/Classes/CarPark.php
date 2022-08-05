<?php namespace App\Classes;

use Validator;
use Illuminate\Support\Facades\DB;

class CarPark extends EST {
    
    /**
     * Returns number of Season Tickets sold for a given Car Park.
     *
     * @param  INT $carpark_id
     * @return INT
     */
    public static function numberOfMultiTicketsSoldForACarPark( $carpark_id ) {
        
        return 0; // Return 0 until revisited.
        
        $orders = DB::table('car_parks')
                ->join('multi_tickets'     , 'multi_tickets.car_park_id'   , '='   , 'car_parks.id')
                ->join('order_details'      , 'order_details.multi_ticket_id' , '='   , 'multi_tickets.id')
                ->select('order_details.id')
                ->where('order_details.status', _ORDER_STATUS_SUCCESSFUL_)
                ->get();
        
        return (INT)count($orders);
        
    }
    
    /**
     * Returns number of Season Tickets checked in for a given Car Park.
     *
     * @param  INT $carpark_id
     * @return INT
     */
    public static function numberOfMultiTicketsCheckedInForACarPark( $carpark_id, $event_id ) {
        
        $orders = DB::table('multi_tickets')
                ->join('multi_ticket_groups'  ,'multi_tickets.multi_ticket_group_id'    , '='   , 'multi_ticket_groups.id')
                ->join('multi_ticket_events'    , 'multi_ticket_events.multi_ticket_group_id'   ,'='    ,'multi_ticket_groups.id')
                ->where('multi_ticket_events.event_id'  , $event_id)
                ->where('multi_tickets.car_park_id'     , $carpark_id)
                ->select('multi_tickets.used')
                ->get();
        
        return (INT)count($orders);
        
        $orders = DB::table('car_parks')
                ->join('multi_tickets'     , 'multi_tickets.car_park_id'   , '='   , 'car_parks.id')
                ->select('multi_tickets.used')
                ->get();
        
        return (INT)count($orders);
        
    }
     
    public static function carParkExists($carpark_id, $event_id) {
        
        $Products = \App\Models\ProductModel::where('event_id', $event_id)->where('car_park_id', $carpark_id)->get();
        return (BOOL)$Products->count();
    }
    /**
     * Validates input fields for a 'Add Car Park' to event form.
     *
     * @param  Array $input Form Fields
     * @return Validator object
     */
    public static function validateAddCarParkInput( $input ) {
        
        //
        // Customise attributes names for display.
        $customAttributes = array(
            'product_price' => 'Price',
            'product_open' => 'Opening Time',
            'product_close' => 'Closing Time',
            'product_allocated' => 'Allocated',
            'product_car_park_id' => 'Car Park',
            'product_event_id' => 'Event',
            'product_status' => 'Status'
        );
        
        //
        // Define custom messages.
        $messages = array(
            'product_price.integer' => 'The Price is not valid.',
            'product_price.min' => 'The Price must be at least £1.00.',
            'product_event_id.required' => 'Upable to find the related :attribute.',
            'product_car_park_id.required' => 'No Car Park selected.',
            'product_allocated.integer' => 'The :attribute must be a whole number.',
            'product_open.date_format' => 'The :attribute does not match the format HH:MM.',
            'product_close.date_format' => 'The :attribute does not match the format HH:MM.',
        );        
        
        //
        // Set validation rules
        $rules = array(
            'product_price'         => 'required|integer|min:100',
            'product_open'          => 'required|date_format:H:i',
            'product_close'         => 'required|date_format:H:i',
            'product_allocated'     => 'required|integer',
            'product_status'        => 'required|string',
        );
        
        if ( !$input['product_id'] ) {

            $rules['product_car_park_id'] = 'required|numeric';
            $rules['product_event_id'] = 'required|numeric';

        }
        
        //
        // Apply validation rules
        return Validator::make($input, $rules, $messages, $customAttributes);

    }
    
    /**
     * Fetches all the car parks
     *
     * @return Array of all the car parks
     */
    public static function getAllCarParks() {
        
        $carParks = DB::table('car_parks')
                ->join('car_parks_lang' , 'car_parks_lang.car_park_id', '=' ,'car_parks.id')
                ->select('car_parks_lang.*', 'car_parks.capacity')
                ->orderBy('name', 'asc')
                ->get();
        
        $ret = array();
        foreach($carParks as $carPark) {
            
            $ret[] = array(
                   'carParkId' => $carPark->car_park_id
                    , 'carParkName' => $carPark->name
                    , 'capacity' => $carPark->capacity
            );
        }
        
        return $ret;
        
    }
    
    /**
     * Fetches all the car parks
     *
     * @return Array of all the car parks
     */
    public static function getCarParkBySku($sku) {
        
             $result = DB::table('car_parks')
                     ->where([
                         ['sku', '=', $sku]
                            ])
                     ->first(['id']);

            if ($result){
                return $result->id;
            }else{
                return NULL;
            }
        
    }  

    /**
     * Validates input fields for Add / Edit Car Park form.
     *
     * @param  Array $input Form Fields
     * @return Validator object
     */
    public static function validateAddEditCarParkInput( $input ) {
        
        //
        // Customise attributes names for display.
        $customAttributes = array(
            'car_park_name' => 'Name',
            'car_park_sku' => 'Sku',
            'car_park_capacity' => 'Capacity',
            'car_park_lat' => 'Lat',
            'car_park_long' => 'Lng',
            'car_park_featured' => 'Featured',
            'car_park_priority' => 'Priority'
        );
        
        //
        // Define custom messages.
        $messages = array(
            'car_park_name.string' => 'Name is not valid',
            'car_park_name.min' => 'Name must be at least 2 characters',
            'car_park_sku.string' => 'Sku is not valid',
            'car_park_sku.min' => 'Sku must be at least 1 character',
            'car_park_capacity.string' => 'Capacity is not valid',
            'car_park_lat.string' => 'Lat is not valid',
            'car_park_long.string' => 'Lng is not valid',
            'car_park_priority.string' => 'Priority is not valid',
            'car_park_priority.max' => 'Priority must be less than 2 characters'
        );        
        
        //
        // Set validation rules
        $rules = array(
            'car_park_name' => 'required|string|min:2|max:255',
            'car_park_sku' => 'required|string|min:1|max:100',
            'car_park_capacity' => 'required|string|max:11',
            'car_park_lat' => 'string|max:45',
            'car_park_long' => 'string|max:45',
            'car_park_featured' => 'required',
            'car_park_priority' => 'string|max:2'
        );
        
        // Apply validation rules
        return Validator::make($input, $rules, $messages, $customAttributes);

    }  
    
}