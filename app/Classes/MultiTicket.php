<?php namespace App\Classes;

use Log;
use Validator;
use App\Models\MultiTicketGroupModel;
use App\Models\CarParkModel;
use Illuminate\Support\Facades\DB;

class MultiTicket extends EST {
    
    /**
     * Returns details of season tickets for a given group id 
     *
     * @param INT $id Season Ticket Group ID
     * 
     * @return Array
     */
    public static function getDetails( $id ) {
        
        $arrTicketDetails   = array();
        $arrTickets         = array();
        
        //
        // Fetch MT Group and store data for the view
        $MultiticketGroups          = MultiTicketGroupModel::find( $id );
        $arrTickets['groupName']    = $MultiticketGroups->lang->name;
        $arrTickets['groupId']      = $MultiticketGroups->id;
        
        //
        // Get MT for the given Group and process it
        $Tickets = self::getMultiticketsForAGroup( $id );        
        foreach($Tickets as $Ticket) {
            $arrTicketDetails[] = self::formatMultiticketDetails($Ticket);
        }

        //
        // Store MT data for the view and return all the details
        $arrTickets['details'] = $arrTicketDetails;        
        return $arrTickets;
        
    }
    
    /**
     * Formats and return details of a season ticket for a MultiTicket object 
     *
     * @param App\Models\MultiTicketModel $Ticket
     * 
     * @return Array
     */
    public static function formatMultiticketDetails( $Ticket ) {
        
            $arrTicket = array();
            
            //
            // Calculate availability
            $numberSold = CarPark::numberOfMultiTicketsSoldForACarPark( $Ticket->car_park_id );
            $pecentage = 100 - (INT)Tools::calculate_percentage( $numberSold, $Ticket->spaces );            
            $arrTicket['capacity_status'] = _CARPARK_AVAILABLE_TEXT_;            
            if ( $pecentage >= _CARPARK_SOLD_FIGURE_ )      $arrTicket['capacity_status'] = _CARPARK_SOLD_TEXT_;
            if ( $pecentage >= _CARPARK_LIMITED_FIGURE_ )   $arrTicket['capacity_status'] = _CARPARK_LIMITED_TEXT_;
            

            $CarPark = CarParkModel::find( $Ticket->car_park_id );

            //
            // Car Park details
            $arrTicket['multiTicketId'] =         $Ticket->multiTicketId;
            $arrTicket['carparkName'] =           $CarPark->lang->name;
            $arrTicket['carparkDescription'] =    $CarPark->lang->description;
            $arrTicket['openingTime'] =           $CarPark->opening_time;
            $arrTicket['closingTime'] =           $CarPark->closing_time;
            $arrTicket['carparkLat'] =            $CarPark->lat;
            $arrTicket['carparkLong'] =            $CarPark->long;            
            $arrTicket['price'] =                 Tools::penceToPound($Ticket->price);
            
            return $arrTicket;
    }
    
    /**
     * Formats and returns details of a season ticket for basket view 
     *
     * @param App\Models\MultiTicketModel $Ticket
     * 
     * @return Array
     */
    public static function formatMultiticketDetailsForBasketView( $Ticket ) {
        
            $arrTicket = array();                       

            $CarPark = CarParkModel::find( $Ticket->car_park_id );
            $MTGroup = MultiTicketGroupModel::find( $Ticket->multi_ticket_group_id );

            //
            // Car Park details
            $arrTicket['multiTicketId'] =         $Ticket->id;
            $arrTicket['carparkName'] =           $CarPark->lang->name;
            $arrTicket['carparkDescription'] =    $CarPark->lang->description;
            $arrTicket['carparkLat'] =            $CarPark->lat;
            $arrTicket['carparkLong'] =            $CarPark->long;            
            $arrTicket['price'] =                 $Ticket->price;
            $arrTicket['multiTicketGroupId'] =      $Ticket->multi_ticket_group_id;
            $arrTicket['multiTicketGroupName'] =    $MTGroup->lang->name;
            
            return $arrTicket;

    }
    
    /**
     * Fetches all Multi Tickets for a given MT Group Id 
     *
     * @param INT $id MT Group ID
     * 
     * @return Array of Multi Ticket objects
     */
    public static function getMultiticketsForAGroup( $id ) {
        
        $multiTickets = DB::table('multi_tickets')
                ->join('car_parks'  , 'car_parks.id'    , '='   , 'multi_tickets.car_park_id')
                ->where('multi_tickets.status', _STATUS_ONLINE_ )
                ->where('multi_tickets.multi_ticket_group_id' , '=' , $id)
                ->select('multi_tickets.*', 'multi_tickets.id as multiTicketId', 'car_parks.*')
                ->orderBy('car_parks.priority')
                ->get();
        
        return $multiTickets;
    }
    
     /**
     * Returns a list of season tickets paginated.
     *
     * @param  String $orderBy ( 'date' | 'title' )
     * @param INT $categoryId ( 0 = all)
     * @param String $status ( 'all' | 'active' | 'inactive' )
     * @param BOOL $includedOld
     * 
     * @return Array
     */
    public static function loadAllMultiTickets($status='all') {

        // Set order by
        $orderBy = "name";       
        
        // Set status to look for
        $inStatus = array();
        $status = strtolower($status);
        if ( $status == _STATUS_ONLINE_ || $status == _STATUS_OFFLINE_ ) {
            $inStatus[] = $status;
        } else {
            $inStatus[] = _STATUS_OFFLINE_;
            $inStatus[] = _STATUS_ONLINE_;            
        }
        //                ->whereIn('multi_ticket_groups.status', $inStatus)
        
        // Create and run the query
        $multitickets = DB::table('multi_ticket_groups')
                ->join('multi_ticket_groups_lang'    ,'multi_ticket_groups_lang.multi_ticket_group_id' ,'='    ,'multi_ticket_groups.id')
                ->select('multi_ticket_groups.id', 'multi_ticket_groups.category_id',  'multi_ticket_groups.status', 'multi_ticket_groups_lang.name')
                ->orderBy($orderBy)
                ->paginate(10);

        \Log::info('Classes: MultiTickets: '. count($multitickets));
        
        return $multitickets;

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
    
}