<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\EstController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Classes\Tools;
use App\Classes\Event;
use Illuminate\Support\Facades\DB;
use Log;
use App\Jobs\SendMailShot;


class TempController extends EstController
{
    
    public function mailShot() {
        
        $event_id = Input::get('event_id');
        
        $Events = (array)DB::table('orders')
                ->join('users'                  , 'users.id'                    , '='   , 'orders.user_id')
                ->join('order_details'          , 'order_details.order_id'     , '='   , 'orders.id')
                ->join('single_tickets'         , 'single_tickets.id'           , '='   , 'order_details.single_ticket_id')
                ->join('products'               , 'products.id'                 , '='   , 'single_tickets.product_id')
                ->join('events'                 , 'events.id'                   , '='   , 'products.event_id')
                ->join('events_lang'            , 'events_lang.event_id'       , '='   , 'events.id')
                ->select('users.firstname', 'users.email', 'events_lang.title', 'order_details.plate_id')
                ->where('events.id', $event_id)
                ->where('order_details.status', _ORDER_STATUS_SUCCESSFUL_)
                ->where('order_details.single_ticket_id', '!=', 0)
                ->whereNotNull('order_details.single_ticket_id')
                ->distinct()
                ->orderBy('users.email')
                ->get();

        echo count($Events).'<br>';
        
        Log::info('----------------------------');
        Log::info('MAIL SHOT');
        Log::info('----------------------------');
  
        $count = 0;
        foreach($Events as $Event) {
            if ( $count == 1) {
                continue;
            }
            $count++;
            if ( $count > 500 ) {
                \Illuminate\Support\Facades\DB::reconnect();        
                echo '<br>Reconnecting to DB.';
                $count = 0;
            }
            echo '<br>'.$count.' -> '.$Event->title. ' - ' .ucwords(strtolower($Event->firstname)).' '.$Event->email.' ---- '.$Event->plate_id. ' '.(INT)$Event->plate_id;
            
            \Log::info('Creating email shot job for: '.$Event->email);
            $job = new SendMailShot($Event);        
            dispatch( $job );                
        }
        
//        $weekEmail = new Postman( User::findOrNew( $event['usersId'] ) );
//        $weekEmail->sendEmailFor1WeekReminder($event);
                
    }
    
    public function cancelOrder() {
        
        if ( Input::get('action') == 'cancel' ) {
            self::changeStatus(Input::get('order_detail_id'), _ORDER_STATUS_CANCELLED_);
        } elseif (Input::get('user_id')) {
            self::showOrderDetails(Input::get('user_id'));
        } elseif (Input::get('order_ref')) {
            $Order = \App\Models\OrderModel::where('order_ref', trim(Input::get('order_ref')))->first();
            self::showOrderDetails($Order->user_id);
        }
    }
    
    public function changeStatus($od_id, $newStatus) {
        
        $OrderDetail = \App\Models\OrderDetailModel::find($od_id);
        $OrderDetail->status = $newStatus;
        if ( $OrderDetail->save() ) {
            Log::info('Booking cancelled: '.$od_id);
            echo '<br>Cancelled.';
        } else {
            Log::error('Unable to cancel booking: '.$od_id);
            echo '<br>Unable to cancel.';
        }

    }
    public function showOrderDetails($user_id) {
        
        $User = \App\User::find($user_id);
        $Address = $User->Address;
        $Orders = $User->AllOrders;
        
        $tab = '---';
        
        foreach($Orders as $Order) {
            
            $OrderDetails = $Order->OrderDetails;
            
            echo $User->getFullname().', '.$User->email.' - '.$Address->address1.' '.$Address->address2.' '.$Address->postcode.'<br>';
            echo $tab. ' ORDER: '.$Order->order_ref.' - '.$Order->created_at;
            
            $count = 1;
            foreach($OrderDetails as $OrderDetail) {
                
                echo '<br>';
                echo $tab.$tab.' '.$count;
                echo '. STATUS: '.$OrderDetail->status.' PLATE: '.$OrderDetail->plate_id;
                echo ' PRICE: '. Tools::penceToPound($OrderDetail->price_paid, true);
                echo ' CAR_PARK: '.$OrderDetail->single_ticket_id.' ---- ';
                echo '<a href="?action=cancel&order_detail_id='.$OrderDetail->id.'">Cancel</a>';

                $count++;
            }

            
            echo '<br>=======================<br>';
            
        }
    }
}
