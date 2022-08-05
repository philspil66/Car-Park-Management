<?php namespace App\Classes;

use App\Models\CarParkModel;
use Illuminate\Support\Facades\DB;

class SingleTicket extends EST {

    /**
     * Given a SingleTicket object, this method gathers and formats related data for basket view 
     *
     * @param  \App\Models\SingleTicketModel $Ticket
     * @return Array
     */
    public static function formatSingleticketDetailsForBasketView(\App\Models\SingleTicketModel $Ticket ) {
        
            $arrTicket = array();                  
            
            $Event = $Ticket->product->event;
            
            $arrTicket['ticketId'] = $Ticket->product_id;
            $arrTicket['eventId'] = $Event->id;
            $arrTicket['price'] = $Ticket->price;
            $arrTicket['eventTitle'] = $Event->lang->title;
            $arrTicket['eventDate'] = Tools::dateformat( $Event->date );
            $arrTicket['eventTime'] = Tools::timeformat( $Event->time );
            
            if ( $Event->team1_id > 0 && $Event->team2_id > 0 ) {
                $TeamOne = $Event->teamone;
                $TeamTwo = $Event->teamtwo;
                $arrTicket['teamOneLogo'] = $TeamOne->logo;
                $arrTicket['teamTwoLogo'] = $TeamTwo->logo;
                $arrTicket['teamOneName'] = $TeamOne->lang->name;
                $arrTicket['teamTwoName'] = $TeamTwo->lang->name;
            } else {
                $arrTicket['teamOneLogo'] = '';
                $arrTicket['teamTwoLogo'] = '';
                $arrTicket['teamOneName'] = '';
                $arrTicket['teamTwoName'] = '';
                
            }
            $arrTicket['carparkName'] = $Ticket->product->carpark->lang->name;
            
            
            return $arrTicket;
            
    }
    
    /**
     * Given an event id, this method returns data for temporary web app for checking in cars.
     * Only for single events for now. 
     *
     * @param  INT $eventId
     * @return Array
     */
    public static function getSingleTicketCheckInDataForAnEvent( $eventId ) {
        
        $data = (array)DB::table('products')
                ->join('single_tickets' ,'single_tickets.product_id', '=', 'products.id')
                ->join('order_details'  ,'order_details.single_ticket_id',  '=',    'single_tickets.id')
                ->join('orders' ,'order_details.order_id',  '=',    'orders.id')
                ->join('users'  ,'users.id',    '=',    'orders.user_id')
                ->join('addresses', 'orders.address_id', '=',    'addresses.id')
                ->join('car_parks', 'car_parks.id', '=',    'products.car_park_id')
                ->leftjoin('plates',    'plates.id',  '=',   'order_details.plate_id')
                ->where('products.status', _STATUS_ONLINE_ )
                ->where('order_details.status', _ORDER_STATUS_SUCCESSFUL_ )
                ->where('products.event_id' , $eventId)
                ->select('addresses.postcode', 'car_parks.sku', 'orders.order_ref', 'users.firstname', 'users.lastname', 'users.telephone', 'plates.plate_number')
                ->get();
        
        $retData = array();
        foreach($data as $row) {
            $retData[] = array(
                'pn' =>             str_replace('null', '', $row->plate_number)
                    , 'pc' =>       str_replace('null', '', $row->postcode)
                    , 'or' => '#'.  str_replace('null', '', Tools::stripSpaces( Tools::stripHexSpace( $row->order_ref )))
                    , 'fn' =>       strtoupper(trim($row->firstname.' '.$row->lastname))
                    , 'tn' =>       str_replace('null', '', $row->telephone)
                    , 'cp' =>       strtoupper(str_replace('null', '', $row->sku))
            );
        }
        
        return $retData;
    }
}