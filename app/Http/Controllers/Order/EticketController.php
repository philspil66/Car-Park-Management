<?php

namespace App\Http\Controllers\Order;

use App\User;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\EstController;
use App\Classes\eTicket;

class EticketController extends EstController
{
    public function getEticket() {
                
        $token = Input::get('token');
        try {
            

            //
            // Find order details
            $OrderDetail = \App\Models\OrderDetailModel::where('guid', $token)->firstOrFail();

            
            
            //
            // Get ticket information
            if ( $OrderDetail->multi_ticket_id ) {
                $eTicket = eTicket::getETicketForMultiTicket( $token );
            } else {
                $eTicket = eTicket::getETicketForSingleTicket( $token );
            }
            
            
            
            //
            // Set ticket type
            $eTicket['ticket_type'] = _TICKET_TYPE_GUEST_;
            
            if ( array_key_exists('team1logo', $eTicket) && array_key_exists('team2logo', $eTicket) && strlen($eTicket['team1logo']) && strlen($eTicket['team2logo']) ) {
                
                $eTicket['ticket_type'] = _TICKET_TYPE_SINGLE_VS_;
            } else {
                
                if (array_key_exists('multi_ticket_id', $eTicket) && $eTicket['multi_ticket_id'] > 0) {
                    
                    $eTicket['ticket_type'] = _TICKET_TYPE_MULTI_;                    
                    
                } else {
                    
                    $eTicket['ticket_type'] = _TICKET_TYPE_SINGLE_;
                    
                }
            }
            
            
            
            
        } catch (\Exception $ex) {

            \Log::critical('Trying to get eTicket datea but OrderDetails record not found: '.$ex->getMessage());
        }

        
        
    
        $myViewData = \View::make('site.account.ticket', compact('eTicket'))->render();
        

//          echo $myViewData;      

        //
        // Create & download PDF
        $pdf = \PDF::loadHTML($myViewData)->setPaper('a4')->setOrientation('landscape');
        return $pdf->download('est_'.time().'.pdf');

    }
}
