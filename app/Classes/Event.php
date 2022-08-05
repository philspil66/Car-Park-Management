<?php namespace App\Classes;

use Log;
use App\User;
use Carbon\Carbon;
use App\Models\EventModel;
use Illuminate\Support\Facades\DB;
use Validator;

class Event extends EST {
    
    
    /**
     * Retruns Event type.
     *
     * @param  \App\Model $Event
     * @return String
     */
    public static function getEventType( $Event ) {

        if ( $Event->teamone && $Event->teamtwo ) {
            return _EVENT_TYPE_VS_;
        } else {
            return _EVENT_TYPE_NON_VS_;
        }
        
    }
    
    /**
     * Retruns Events that a given customer has bought tickets for. 
     * If date given then returns event(s) for that date only.
     *
     * @param  INT $user_id
     * @param  String $date
     * 
     * @return Array
     */
    public static function getEventsForACustomer( $user_id, $date = '' ) {
        
        $arrEvents = array();
        
        //
        // Get Single Events
        //
        $Events = self::getSingleEventsForACustomer( $user_id, $date = '' );
        foreach($Events as $Event) {
            $arrEvents[] = $Event;
        }
        
        //
        // Get Multi Events
        //
        $Events = self::getMultipleEventsForACustomer( $user_id );
        foreach($Events as $Event) {
            $arrEvents[] = $Event;
        }

        return $arrEvents;
        
    }
    
    /**
     * Retruns Single Ticket Events that a given customer has bought tickets for. 
     * If date given then returns event(s) for that date only.
     *
     * @param  INT $user_id
     * @param  String $date
     * 
     * @return Array
     */
    public static function getSingleEventsForACustomer( $user_id, $date = '' ) {
        
        $arrEvents = array();
        
        $Events_Single = (array)DB::table('orders')
                ->join('order_details'          , 'order_details.order_id'     , '='   , 'orders.id')
                ->join('single_tickets'         , 'single_tickets.id'           , '='   , 'order_details.single_ticket_id')
                ->join('products'               , 'products.id'                 , '='   , 'single_tickets.product_id')
                ->join('events'                 , 'events.id'                   , '='   , 'products.event_id')
                ->join('events_lang'            , 'events_lang.event_id'       , '='   , 'events.id')
                ->select('events.*', 'events_lang.*')
                ->where('orders.user_id', $user_id)
                ->where('events.date', '>=', Carbon::now()->format('Y-m-d'))
                ->where('order_details.single_ticket_id', '!=', 0)
                ->whereNotNull('order_details.single_ticket_id')
                ->distinct()
                ->orderBy('events.date')
                ->orderBy('events.time')
                ->get();
        
        foreach($Events_Single as $Event) {

            /*
             * Brian wants the events to be visible on My Account until midnight 
             * of the day of event, hence commenting this out. AyyazH 30-Jun-2016.
             * 
            // Ignore any events in the past.
            if ( strtotime($Event->date.' '.$Event->time) < time() ) {
                
                //continue;
            }
             * 
             */
            
            // If date is given then ignore events scheduled for other dates.
            if ( strlen(trim($date)) > 0 && ( strtotime($date) != strtotime($Event->date)) ) {
                
                continue;
            }
            
            // Format and return events data
            $arrEvents[] = array(
                    'eventId' => $Event->event_id
                    , 'eventType' => _TICKET_TYPE_SINGLE_
                    , 'eventTitle' => $Event->title
                    , 'eventDescription' => $Event->description
                    , 'eventDate' => $Event->date
                    , 'eventTime' => $Event->time
                
            );
        }
        
        return $arrEvents;
    }
    
    /**
     * Retruns Season Tickets that a given customer has bought tickets for. 
     *
     * @param  INT $user_id
     * 
     * @return Array
     */
    public static function getMultipleEventsForACustomer( $user_id ) {
    //
    // For Season/Multi tickets, there's no Event 
    // so return top level group for multi tickets
    //    
        $arrEvents = array();
        
        $Events_Multi = (array)DB::table('orders')
                ->join('order_details'          , 'order_details.order_id'     , '='   , 'orders.id')
                ->join('multi_tickets'           , 'multi_tickets.id'             , '='   , 'order_details.multi_ticket_id')
                ->join('multi_ticket_groups'      , 'multi_tickets.multi_ticket_group_id'       , '='   , 'multi_ticket_groups.id')
                ->join('multi_ticket_groups_lang'      , 'multi_ticket_groups_lang.multi_ticket_group_id'       , '='   , 'multi_ticket_groups.id')
                ->select('multi_ticket_groups_lang.*')
                ->where('orders.user_id', $user_id)
                ->where('order_details.multi_ticket_id', '!=', 0)
                ->whereNotNull('order_details.multi_ticket_id')
                ->distinct()
                ->get();
        
        foreach($Events_Multi as $Event) {

            $arrEvents[] = array(
                    'eventId' => $Event->id
                    , 'eventType' => _TICKET_TYPE_MULTI_
                    , 'eventTitle' => $Event->name
                    , 'eventDescription' => $Event->description
                
            );
        }
        
        return $arrEvents;
    }
    
    /**
     * Retruns Events for a given date where no plate exists.
     *
     * @param  String $targetDate
     * 
     * @return Array
     */
    public static function eventsForDateWithNoPlate( $targetDate ) {
        
        $Events_Single = (array)DB::table('events')
                ->join('products'          , 'products.event_id'     , '='   , 'events.id')
                ->join('single_tickets'     , 'single_tickets.product_id',   '=',    'products.id')
                ->join('order_details'               , 'order_details.single_ticket_id'                 , '='   , 'single_tickets.id')
                ->join('orders'                 , 'orders.id'                   , '='   , 'order_details.order_id')
                ->join('users'            , 'orders.user_id'       , '='   , 'users.id')
                ->join('events_lang'        , 'events_lang.event_id'   , '='   , 'events.id')
                ->leftJoin('plates'                 , 'plates.id'                   , '='   , 'order_details.plate_id')
                ->select('events.id as event_id', 'events.*', 'events_lang.title', 'users.id as user_id', 'plates.plate_number', 'orders.*')
                ->where('order_details.single_ticket_id', '!=', 0)
                ->where(DB::raw('LENGTH(users.email)'), '!=', 0)
                ->where('events.date', '=', $targetDate)
                ->whereNotNull('order_details.single_ticket_id')
                ->where(function($query){
                    return $query
                            ->where('plate_id', '=', 0)
                            ->orWhere('plate_id', '=', NULL);
                })
                ->distinct()
                ->get();
        
        $arrEvents = array();
        foreach($Events_Single as $Event) {

            $arrEvents[] = array(
                    'eventId' => $Event->event_id
                    , 'eventTitle' => $Event->title
                    , 'plateNumber' => $Event->plate_number
                    , 'usersId' => $Event->user_id
                    , 'eventDate' => $Event->date
                    , 'eventTime' => $Event->time
                
            );

        }
 
        return $arrEvents;
    }
    
    /**
     * Retruns Events for a given date.
     *
     * @param  String $targetDate
     * 
     * @return Array
     */
    public static function eventsForDate( $targetDate ) {
        
        $Events_Single = (array)DB::table('events')
                ->join('products'          , 'products.event_id'     , '='   , 'events.id')
                ->join('order_details'               , 'order_details.product_id'                 , '='   , 'products.id')
                ->join('orders'                 , 'orders.id'                   , '='   , 'order_details.order_id')
                ->join('users'            , 'orders.user_id'       , '='   , 'users.id')
                ->join('events_lang'        , 'events_lang.event_id'   , '='   , 'events.id')
                ->leftJoin('plates'                 , 'plates.id'                   , '='   , 'order_details.plate_id')
                ->select('events.id as event_id', 'events.*', 'events_lang.title', 'users.id as user_id', 'plates.plate_number', 'orders.*')
                ->where('order_details.product_id', '!=', 0)
                ->where(DB::raw('LENGTH(users.email)'), '!=', 0)
                ->where('events.date', '=', $targetDate)
                ->whereNotNull('order_details.product_id')
                ->distinct()
                ->get();
        
        $arrEvents = array();
        foreach($Events_Single as $Event) {

            $arrEvents[] = array(
                    'eventId' => $Event->event_id
                    , 'eventTitle' => $Event->title
                    , 'plateNumber' => $Event->plate_number
                    , 'usersId' => $Event->user_id
                    , 'eventDate' => $Event->date
                    , 'eventTime' => $Event->time
                
            );

        }
 
        return $arrEvents;
    }

    /**
     * Retruns number of single (ordinary customer) tickets sold for a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return INT
     */
    public static function singleTicketsSoldForAnEvent( $EventId ) {

        $Event = EventModel::find($EventId);
        $Products = $Event->products;
        $product_ids = array();
        foreach($Products as $Product) {
            if ($Product->status == _STATUS_ONLINE_) {
                $product_ids[] = $Product->id;
            }
        }

        $singleTickets = DB::table('single_tickets')
                ->join('order_details' , 'order_details.single_ticket_id'   ,'='    ,'single_tickets.id')
                ->where('order_details.status', '=',    _ORDER_STATUS_SUCCESSFUL_)
                ->whereIn('single_tickets.product_id' , $product_ids)
                ->select('single_tickets.id')
                ->get();
        
        return (INT)count( $singleTickets );

    }

    /**
     * Retruns number of plates entered for single (ordinary customer) tickets for a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return INT
     */
    public static function platesEnteredForAnEvent( $EventId ) {
        
        $platesEntered = DB::table('events')
                ->join('products'   , 'products.event_id'  ,'='    ,'events.id')
                ->join('single_tickets' , 'single_tickets.product_id'   ,'='    ,'products.id')
                ->join('order_details'  , 'order_details.single_ticket_id'  ,'='    ,'single_tickets.id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('events.id', $EventId)
                ->where('order_details.plate_id', '>', 0)
                ->where('order_details.status', '=', _ORDER_STATUS_SUCCESSFUL_)
                ->whereNotNull('order_details.single_ticket_id')
                ->where('order_details.single_ticket_id', '>', 0)
                ->whereNotNull('order_details.plate_id')
                ->select('order_details.plate_id')
                ->get();

        return (INT)count( $platesEntered );

    }
    
    /**
     * Retruns car park objects assigned to a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return Collection of CarParks objects
     */
    public static function carParksForAnEvent( $EventId ) {
        
        $carParks = (array)DB::table('events')
                ->join('products'       , 'products.event_id'   , '='   , 'events.id')
                ->join('car_parks'      , 'car_parks.id'        , '='    , 'products.car_park_id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('events.id' , '=' , $EventId)
                ->select('products.allocated', 'car_parks.capacity')
                ->get();

        return $carParks;
    }
    
    /**
     * Retruns number of spaces wasted for a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return INT
     */
    public static function wastageForAnEvent( $EventId ) {
        
        $wastage = (array)DB::table('events')
                ->join('products'       , 'products.event_id'   , '='   , 'events.id')
                ->join('wastages'      , 'wastages.product_id'        , '='    , 'products.id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('events.id' , '=' , $EventId)
                ->selectRaw('SUM(spaces) as totalSpaces')
                ->get();
        
        return (INT)$wastage[0]->totalSpaces;
    }
    
    /**
     * Retruns number of season/multi tickets for a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return INT
     */
    public static function multiTicketsSoldForAnEvent( $EventId ) {

        return 0; // Return 0 until revisited.
        
        $multiTickets = DB::table('events')
                ->join('products'   , 'products.event_id'  ,'='    ,'events.id')
                ->join('car_parks'  , 'car_parks.id'    , '='   , 'products.car_park_id')
                ->join('multi_tickets' , 'multi_tickets.car_park_id'   ,'='    ,'car_parks.id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('events.id' , '=' , $EventId)
                ->select('multi_tickets.id')
                ->get();
        
        return (INT)count( $multiTickets );

    }

    /**
     * Retruns number of season/multi tickets checked in for a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return INT
     */
    public static function multiTicketsCheckedInForAnEvent( $EventId ) {
        
        return 0; // Return 0 until revisited.
        
        $multiTickets = DB::table('events')
                ->join('products'   , 'products.event_id'  ,'='    ,'events.id')
                ->join('car_parks'  , 'car_parks.id'    , '='   , 'products.car_park_id')
                ->join('multi_tickets' , 'multi_tickets.car_park_id'   ,'='    ,'car_parks.id')
                ->join('order_details'  , 'multi_tickets.id'    , '='   , 'order_details.multi_ticket_id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('order_details.status', '=', _ORDER_STATUS_SUCCESSFUL_)
                ->whereNotNull('order_details.multi_ticket_id')
                ->where('order_details.multi_ticket_id', '>', 0)
                ->where('events.id' , '=' , $EventId)
                ->select('multi_tickets.id')
                ->get();
        
        return (INT)count( $multiTickets );

    }
    
    /**
     * Retruns number of guest spaces reserved for a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return INT
     */
    public static function guestsSpacesForAnEvent( $EventId ) {
        
        $guestsSpaces = DB::table('events')
                ->join('products'   , 'products.event_id'  ,'='    ,'events.id')
                ->join('guest_lists'  , 'guest_lists.product_id'    , '='   , 'products.id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('events.id' , '=' , $EventId)
                ->selectRaw('SUM(guest_lists.spaces) as guestsSpaces')
                ->get();
        
        return (INT)$guestsSpaces[0]->guestsSpaces;
    }
    
    /**
     * Retruns number guests checked in for a given Event.
     *
     * @param  \App\Models $Event
     * 
     * @return INT
     */
    public static function guestsCheckedInForAnEvent( $EventId ) {
        
        $guestsCheckedIn = DB::table('events')
                ->join('products'   , 'products.event_id'  ,'='    ,'events.id')
                ->join('guest_lists'  , 'guest_lists.product_id'    , '='   , 'products.id')
                ->join('guest_list_guests', 'guest_list_guests.guest_list_id'   , '=', 'guest_lists.id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('events.id' , '=' , $EventId)
                ->selectRaw('COUNT(*) as guestsCheckedIn')
                ->get();
        
        return (INT)$guestsCheckedIn[0]->guestsCheckedIn;
    }
    
    /**
     * Retruns certain attributes for a given Event, if Event exists.
     * If event doesn't exist then returns relevant info to create a new event.
     *
     * @param  \App\Models $Event
     * 
     * @return Array
     */
    public static function loadEventAttributes( $Event, $categoryId = 0 ) {
                    
        if ( !$Event ) {
            
            $categoryType = '';
            if ( $categoryId ) {
                $categoryType = \App\Models\CategoryModel::find($categoryId)->type;
            }
            
            $arr_event = array(
                'eventTitle' => 'Create new event'
                , 'eventId' => 0
                , 'carParksCount' => 0
                , 'categoryId' => $categoryId
                , 'categoryType' => $categoryType
            );
            
            return $arr_event;
            
        }
        
        $arr_event = array(
            'eventTitle' => $Event->lang->title
            , 'eventId' => $Event->id
            , 'eventDate' => Tools::dateformat( $Event->date )
            , 'eventTime' => Tools::timeformat( $Event->time )
            , 'carParksCount' => count( $Event->products )
            , 'eventType' => Event::getEventType( $Event )            
        );

        if ( $arr_event['eventType'] == _EVENT_TYPE_VS_ ) {

            $arr_event['team1'] = array(
                'teamId'        => $Event->teamone->id
                , 'teamName'    => $Event->teamone->lang->name
                , 'teamLogo'    => $Event->teamone->logo
            );

            $arr_event['team2'] = array(
                'teamId'        => $Event->teamtwo->id
                , 'teamName'    => $Event->teamtwo->lang->name
                , 'teamLogo'    => $Event->teamtwo->logo
            );
        }

        return $arr_event;
    }
        
    /**
     * Returns a list of Events paginated.
     *
     * @param  String $orderBy ( 'date' | 'title' )
     * @param INT $categoryId ( 0 = all)
     * @param String $status ( 'all' | 'active' | 'inactive' )
     * @param BOOL $includedOld
     * 
     * @return Array
     */
    public static function loadAllEvents($orderBy='', $categoryId=0, $status='all', $includeOld=false) {

        // If 'includeOld' is true then set date to 1970-01-01, otherwise today's date
        $date = date('Y-m-d');            
        if ( $includeOld ) {
            $date = date('');
        }

        // Set order by
        $order = 'title';
        if (strlen($orderBy)) {
            $order = $orderBy;
        }

        // Set categories to look for
        $inCategories = array();
        if ( $categoryId>0 ) {
            $inCategories[] = $categoryId;
        } else {
            $Categories = \App\Models\CategoryModel::all();
            foreach($Categories as $Category) {
                $inCategories[] = $Category->id;
            }
        }
        
        // Set status to look for
        $inStatus = array();
        $status = strtolower($status);
        if ( $status == _STATUS_ACTIVE_ || $status == _STATUS_INACTIVE_ ) {
            $inStatus[] = $status;
        } else {
            $inStatus[] = _STATUS_INACTIVE_;
            $inStatus[] = _STATUS_ACTIVE_;            
        }
        
        // Create and run the query
        $events = DB::table('events')
                ->join('events_lang'    ,'events_lang.event_id' ,'='    ,'events.id')
                ->join('categories'     ,'events.category_id'   ,'='    ,'categories.id')
                ->where('events.date', '>=', $date)
                ->whereIn('events.category_id', $inCategories)
                ->whereIn('events.status', $inStatus)
                ->select('events.id', 'events.category_id', 'events.date', 'events.time', 'events.status', 'events_lang.title', 'categories.slug')
                ->orderBy($order)
                ->paginate(10);

        return $events;

    }
    
    /**
     * Calculates and returns figures for allocated bar on the Events listing page. 
     *
     * @param  Paginator $events 
     * @return Array
     */
    public static function figuresForAllocatedBar( $events ) {
        
        $allocatedBar = array();
        foreach($events as $event) {
            
            $totals = Stats::calculateCapacityAndAllocated( $event->id);                                    
            $allocatedBar[$event->id] = array( 'total' => $totals['totalAllocated'], 'used' => Stats::totalUsageForAnEvent($event->id) );
        }
    
        return $allocatedBar;
    }
    
    /**
     * Returns an event details for a given event id 
     *
     * @param  INT $id Event ID
     * @return Array
     */
    public static function loadAnEvent( $id ) {
        
        $arrProducts = array();
        $arrEvent = array();
        
        $Event = EventModel::find($id);
        
        $arrEvent['eventId'] = $Event->id;
        $arrEvent['eventTitle'] = $Event->lang->title;
        $arrEvent['eventDate'] = Tools::dateformat($Event->date);
        $arrEvent['eventTime'] = Tools::timeformat($Event->time);
        
        $arrProductsSorted = array();
        $arrProductsSold = array();
        foreach($Event->products as $Product) {
            if ($Product->status == _STATUS_ONLINE_) {
                $arrProduct = Product::formatDataFromAProductForFrontEnd($Product);
                
                //
                // Drop SOLD carparks to the bottom
                if ( $arrProduct['capacity_status'] == _CARPARK_SOLD_TEXT_ ) {
                    $arrProductsSold[] = $arrProduct;
                } else {
                    $arrProducts[] = $arrProduct;
                }
            }
        }
        $arrProductsSorted = array_merge($arrProducts, $arrProductsSold);

        $arrEvent['products'] = $arrProductsSorted;
        
        return $arrEvent;
    }
    
    /**
     * Returns all single events with at least one active Product attached for Front End. 
     *
     * @return Array
     */
    public static function getAllSingleEventsForFrontEnd() {

        $arrEvents = array();
        $Events_Single = DB::table('events')
                ->join('products'   ,'products.event_id', '=' ,'events.id')
                ->join('events_lang'    ,'events_lang.event_id' ,'='    ,'events.id')
                ->leftJoin('teams as team1', 'team1.id', '=', 'events.team1_id')
                ->leftJoin('teams_lang as teamsLang1'   ,'teamsLang1.team_id'   ,'='    ,'team1.id')
                ->leftJoin('teams as team2', 'team2.id', '=', 'events.team2_id')
                ->leftJoin('teams_lang as teamsLang2'   ,'teamsLang2.team_id'   ,'='    ,'team2.id')
                ->select('events.*'
                        , 'events_lang.title'
                        , 'team1.logo as team1logo'
                        , 'team2.logo as team2logo'
                        , 'teamsLang1.name as team1name'
                        , 'teamsLang2.name as team2name'
                        )
                ->where('products.status'   ,'='    ,_STATUS_ONLINE_)
                ->where('events.date', '>=', Carbon::now()->format('Y-m-d'))
                ->distinct()
                ->orderBy('events.date')
                ->orderBy('events.time')
                ->get();

        foreach($Events_Single as $Event) {
            
            // Format and return events data
            $arrEvents[] = array(
                    'team1logo' => $Event->team1logo
                    ,'team2logo'    => $Event->team2logo
                    ,'team1name'    => $Event->team1name
                    ,'team2name'    => $Event->team2name
                    , 'eventId' => $Event->id
                    , 'eventTitle' => $Event->title
                    , 'eventType' => _TICKET_TYPE_SINGLE_
                    , 'eventDate' => Tools::dateformat($Event->date)
                    , 'eventTime' => Tools::timeformat($Event->time)
                
            );
        }
        
        return $arrEvents;
    }

    /**
     * Validates input fields for 'Create / Edit Event' form.
     *
     * @param  Array $input Form Fields
     * @return Validator object
     */
    public static function validateCreateEditEventInput( $input ) {
        
        //
        // Customise attributes names for display.
        $customAttributes = array(
            'event_title' => 'Event Name',
            'event_date' => 'Date',
            'event_time' => 'Time',
            'event_status' => 'Status',
            'event_description' => 'Description',
            'event_team1_id' => 'Team 1',
            'event_team2_id' => 'Team 2'
        );
        
        //
        // Define custom messages.
        $messages = array(
            'event_title.string' => 'Event name is not valid',
            'event_date.date_format' => 'Event Date is invalid, format must be yyyy-mm-dd',
            'event_time.date_format' => 'Event Date is invalid, format must be hh:mm',
            'event_description.string' => 'Event Description is not valid',
        );        
        
        //
        // Set validation rules
        $rules = array(
            'event_title' => 'required|string|min:2|max:255',
            'event_date' => 'required|date_format:Y-m-d',
            'event_time' => 'required|date_format:H:i',
            'event_status' => 'required|string',
        );

        if ( $input['category_type'] == 'team'){
            $rules['event_team1_id'] = 'required|integer';
            $rules['event_team2_id'] = 'required|integer';
        }
        
        // Apply validation rules
        return Validator::make($input, $rules, $messages, $customAttributes);

    }


}