<?php

namespace App\Http\Controllers\Account;

//use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EstController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Classes\Refund;
use App\Classes\Event;
use App\Classes\Product;

class AccountController extends EstController
{
     
    public function index() {

        $User = \Auth::user();
        
        //
        // Get Events for a customer
        //
        $Events = Event::getEventsForACustomer( $User->id );
        
        //
        // Get Products
        //
        $Products = Product::getProductsForACustomer( $User->id );

        return view('site.account.account', compact('User', 'Events', 'Products'));
        
    }

    private static function showTeamsEvent( $Event ) {
        
    }
    
    private static function eventType( $data ) {
        
        if ( array_key_exists('team1', $data) && array_key_exists('team2', $data) && (BOOL)$data['team1'] && (BOOL)$data['team2'] ) {

            return _TICKET_TYPE_SINGLE_VS_;
        } else {

            if (array_key_exists('multi_ticket_id', $data) && $data['multi_ticket_id'] > 0) {

                return _TICKET_TYPE_MULTI_;                    

            } else {

                return _TICKET_TYPE_SINGLE_;

            }
        }
        
        
        
         return (BOOL) array_key_exists('team1', $data) && array_key_exists('team2', $data) && strlen($data['team1']) && strlen($data['team2']);
    }
    
    private static function updatePlates( $newPlate ) {
 
        $newPlate = \App\Classes\Tools::stripPlateSpaces($newPlate);
        
        $Plate = \App\Models\PlateModel::where('user_id', Auth::user()->id)->where('plate_number', $newPlate)->first();
        if ( !$Plate ) {
            $Plate = new \App\Models\PlateModel();
            $Plate->user_id = Auth::user()->id;
            $Plate->plate_number = strtoupper($newPlate);
            $Plate->save();
            return $Plate;
        } else {
            return $Plate;
        }
        
        
    }
    public function savePlate() {
//        print_r( Input::all() );
        
        $newPlateFromDb = '';
        if ( Input::has('newPlate') && Input::has('orderDetailId') ) {
            $newPlate = Input::get('newPlate');
            $orderDetailId = Input::get('orderDetailId');
            
            if ( $newPlate && $orderDetailId ) {
                // Save plate in the Plates table
                $Plate = self::updatePlates($newPlate);
                $OrderDetail = \App\Models\OrderDetailModel::find($orderDetailId);
                
                if ( $Plate && $OrderDetail ) {
                    
                    $OrderDetail->plate_id = $Plate->id;
                    $OrderDetail->save();
                    $newPlateFromDb = $Plate->plate_number;
                    
                }
                
                
                
                // Save ids in the order_details
            }
            
            return json_encode( array( 'status' => 1, 'message' => $newPlateFromDb) );
            
        } else {
            
            return json_encode( array( 'status' => 0, 'message' => 'Invalid plate.') );
        }
    }
    public function requestRefund() {
        
        if ( Input::has('orderDetailId') ) {
            
            $refund = new Refund( Input::get('orderDetailId') );            
            return json_encode( $refund->requestRefund() );
            
        } else {
            
            return json_encode( array( 'status' => 0, 'message' => 'Invalid record.') );
        }
        
    }
}
