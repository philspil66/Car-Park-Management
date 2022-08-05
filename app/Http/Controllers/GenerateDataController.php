<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\EventModel;

class GenerateDataController extends EstController
{
    public function forWebApp() {
        return $this->generateData();
    }
    
    public function generateData() {
        
        // Get event for today
        $today = date('Y-m-d');
        $today = '2016-06-03';
        
        // Fetch Event
        $event = EventModel::where('date', '>=', date('Y-m-d'))->orderBy('date', 'asc')->whereHas('products', function($query) {
            $query->where('products.status', _STATUS_ONLINE_);
            })->first();        

        // Fetch single ticket holders for event        
        $singleTicketData = \App\Classes\SingleTicket::getSingleTicketCheckInDataForAnEvent($event->id);
        
        // Fetch Guests for the event
        $GuestListData = \App\Classes\GuestList::getGuestsForAnEvent($event->id);

        // Build vehicles array
        $vehicles = array_merge($singleTicketData,$GuestListData); 
        
        // Build data array
        $data = array(
            "event_name" => $event->lang->title,
            "records"    => $vehicles            
        );
        
        return json_encode( $data );
/*        
        $data = array(
            "event_name" => $event->lang->title,
            "records"   => array(
                array(
                    "pn" => "MYPLATE0",
                    "pc" => "postcode",
                    "or" => "#0123456789",
                    "fn" => "the customers full name",
                    "cp" => "The full name of the car park"
                    ),
                array(
                    "pn" => "UK16 REG",
                    "pc" => "postcode",
                    "or" => "#0123456789",
                    "fn" => "the customers full name",
                    "cp" => "The full name of the car park"
                    )
            )
        );
        
        return json_encode( $data );
 * 
 */
    }
}
