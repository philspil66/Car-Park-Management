<?php namespace App\Classes;

use Log;
use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Redirect;
use App\Classes\Basket;

class Order extends EST {
    
    
    /**
     * Generates and returns unique order_ref.
     *
     * @return INT
     */
    public static function generateUniqueOrderRef() {
        
        $orderRef = 0;
        do {
            
            $orderRef = rand( _ORDER_REF_MIN_, _ORDER_REF_MAX_);
            
        } while( OrderModel::where('order_ref', $orderRef)->first() );

        Log::info('Found a unique random number: '.$orderRef);
        return $orderRef;
        
    }
    
    public static function getOrdersListing() {

        $orders     = array();
        $backDated  = Carbon::now()->subDays(100);

        $search_column  = Input::get('search_column');
        $search_term    = Input::get('search');
        $search_term    = '%' . $search_term['value'] . '%';

        $singleTickets = DB::table('orders')
                ->join('order_details'  ,'orders.id',   '=',    'order_details.order_id')
                ->join('users'          ,'orders.user_id'   ,'='    ,'users.id')
                ->join('single_tickets' ,'order_details.single_ticket_id'   ,'=',    'single_tickets.id')
                ->join('products'       ,'single_tickets.product_id'        ,'=',   'products.id')
                ->join('events'         ,'products.event_id'                ,'=',   'events.id')
                ->selectRaw('orders.id
                        , orders.order_ref
                        , orders.transaction_ref
                        , orders.status
                        , orders.created_at
                        , users.firstname
                        , users.lastname
                        , users.email'                        
                        )
                ->where('events.date'   ,'>='   , $backDated->format('Y-m-d'))              
                ->distinct()
                ->orderBy('orders.id');

                if( $search_column != ''){
                    $singleTickets = $singleTickets->where($search_column, 'like', $search_term);
                }

               $singleTickets = $singleTickets->get();

        foreach($singleTickets as $Ticket) {
            $Ticket = Tools::stripSpacesFromCollectionObject( $Ticket );
            $Ticket->created_at = Tools::dateformat( $Ticket->created_at );
            $Ticket->firstname = strtolower($Ticket->firstname);
            $Ticket->lastname = strtolower($Ticket->lastname);
            $Ticket->email = strtolower($Ticket->email);
            $orders[$Ticket->order_ref] = $Ticket;            
        }

        $multiTickets = DB::table('orders')
                ->join('order_details'  ,'orders.id',   '=',    'order_details.order_id')
                ->join('users'          ,'orders.user_id'   ,'='    ,'users.id')
                ->join('multi_tickets' ,'order_details.multi_ticket_id'   ,'=',    'multi_tickets.id')
                ->join('multi_ticket_groups'       ,'multi_tickets.multi_ticket_group_id'        ,'=',   'multi_ticket_groups.id')
                ->join('multi_ticket_events'        , 'multi_ticket_events.multi_ticket_group_id'   ,'='    ,'multi_ticket_groups.id')
                ->join('events'         ,'multi_ticket_events.event_id'                ,'=',   'events.id')
                ->selectRaw('orders.id
                        , orders.order_ref
                        , orders.transaction_ref
                        , orders.status
                        , orders.created_at
                        , users.firstname
                        , users.lastname
                        , users.email'
                        )
                ->where('events.date'   ,'>='   ,$backDated->format('Y-m-d'))
                ->where('multi_tickets.status', '=', _STATUS_ONLINE_)
                ->distinct()
                ->orderBy('orders.id');

                if( $search_column != ''){
                    $multiTickets = $multiTickets->where($search_column, 'like', $search_term);
                }

                $multiTickets = $multiTickets->get();

        foreach($multiTickets as $Ticket) {
            $Ticket = Tools::stripSpacesFromCollectionObject( $Ticket );
            $Ticket->created_at = Tools::dateformat( $Ticket->created_at );
            $Ticket->firstname = strtolower($Ticket->firstname);
            $Ticket->lastname = strtolower($Ticket->lastname);
            $Ticket->email = strtolower($Ticket->email);
            $orders[$Ticket->order_ref] = $Ticket ;
        }
        
        return $orders;
    }
    
    public static function getOrderDetailsForManagement( $Order ) {
        
        $arrItems = array();
        $arrOrderDetails = array();
        $orderTotal = 0;
        $OrderDetails = $Order->orderDetails;
        
        $arrTemp = array();
        foreach($OrderDetails as $OrderDetail) {

            $arrTemp['orderDetailId'] = $OrderDetail->id;
            $arrTemp['status'] = $OrderDetail->status;
            $arrTemp['price'] = Tools::penceToPound($OrderDetail->price_paid);
            $arrTemp['plateNumber'] = ( is_null($OrderDetail->Plate)?'':$OrderDetail->Plate->plate_number );
            $arrTemp['eTicketHash'] = $OrderDetail->guid;
            
            if ( (INT)$OrderDetail->single_ticket_id > 0 ) {
            
                $Product = $OrderDetail->singleTicket->Product;
              
                $arrTemp['eventName'] = $Product->event->lang->title;
                $arrTemp['carparkName'] = $Product->carpark->lang->name;
                
                
                $orderTotal += $OrderDetail->price_paid;
            }
            
            if ( (INT)$OrderDetail->multi_ticket_id > 0 ) {

                $MultiTicket = $OrderDetail->multiTicket;
                
                $arrTemp['eventName'] = $MultiTicket->multiTicketGroup->lang->title;
                $arrTemp['carparkName'] = $MultiTicket->carpark->lang->name;
                
                $orderTotal += $OrderDetail->price_paid;
            }
            
            $arrOrderDetails[] = $arrTemp;
        }

        $arrItems['orderDetails'] = $arrOrderDetails;
        $arrItems['orderTotal'] = Tools::penceToPound($orderTotal);

        return $arrItems;
        
    }
    
    public static function getOrderDetails( $Order ) {
        
        $arrItems = array();
        $arrOrderDetails = array();
        $orderTotal = 0;
        $OrderDetails = $Order->orderDetails;
  
        foreach($OrderDetails as $OrderDetail) {


            if ( (INT)$OrderDetail->single_ticket_id > 0 ) {
            
                $Product = $OrderDetail->singleTicket->Product;
                $arrOrderDetails[] = array(
                    'product' => $Product->carpark->lang->name .' ('.$Product->event->lang->title.')',
                    'price' => $OrderDetail->singleTicket->price
                );
                
                $orderTotal += $OrderDetail->singleTicket->price;
            }
            
            if ( (INT)$OrderDetail->multi_ticket_id > 0 ) {

                $MultiTicket = $OrderDetail->multiTicket;
                
                $arrOrderDetails[] = array(
                    'product' => $MultiTicket->carpark->lang->name. ' (' .$MultiTicket->multiTicketGroup->lang->name.')',
                    'price' => $MultiTicket->price
                );
                
                $orderTotal += $MultiTicket->price;
            }
        }

        $arrItems['orderDetails'] = $arrOrderDetails;
        $arrItems['orderTotal'] = Tools::penceToPound($orderTotal*100);
        $arrItems['orderCreated'] = Tools::dateformat($Order->created_at). ' ' .Tools::timeformat($Order->created_at);

        return $arrItems;
    }
    
    public static function saveOrder( $orderRef, $transactionId ) {
        
        $orderSaved = null;
                
        $single = Basket::getTicketsFromBasket( _TICKET_TYPE_SINGLE_ );        
        $multi = Basket::getTicketsFromBasket( _TICKET_TYPE_MULTI_ );
        
        if ( count($multi) || count($single) ) {
        //
        // If Single or Multi products exists
        //
        
            
            try {
                
                Log::info('Creating a new Order object.');
                
                
                $Order = new \App\Models\OrderModel();
                $Order->order_ref = $orderRef;
                $Order->transaction_ref = Tools::stripSpaces($transactionId);
                if ( strlen($transactionId) ) {
                    $Order->status = _ORDER_STATUS_SUCCESSFUL_;                    
                } else {
                    $Order->status = _ORDER_STATUS_PENDING_;
                }
                $Order->user_id = Auth::user()->id;
                $Order->address_id = Auth::user()->address_id;
                
                if ( Tools::isPhoneBooking(Auth::user()->email) ) {
                    $Order->type = 'phone';
                }

                $orderSaved = $Order->save();
                Log::info('Order Saved: '.  json_encode($orderSaved));

                
                //
                // If order record saved then process Single products, if any.
                if ( $orderSaved && count($single) ) {
                    self::processAndSaveSingleProducts( $Order->id, $single );
                }
                
                //
                // If order record saved then process Multi products, if any.
                if ( $orderSaved && count($multi)) {
                    self::processAndSaveMultiProducts( $Order->id, $multi );
                }

                $orderSaved = $Order;

            } catch (\Exception $e) {
                
                Log::critical('Error occurred while attempting to save order: '.$e->getMessage());
                return null;    
            }       
            
            //
            // Update session with order_ref
            Session::set('order_ref', $Order->order_ref);

            return $orderSaved;
        }
        
        
    }
    public static function processAndSaveMultiProducts( $orderId, $multi ) {
        
        if ( !$multi || !count($multi) || !$orderId ) {
            Log::info('In processAndSaveMultiProducts: Missing data: OrderId: '.$orderId.', Products Count: '.count($multi));
            return false;
        }
            Log::info('In processAndSaveMultiProducts: Season ticket data: OrderId: '.$orderId.', Products: '.json_encode($multi));
        
        foreach($multi as $item) {
            
                $MultiTicket = \App\Models\MultiTicketModel::find( $item['id'] );
            
                $OrderDetail = new \App\Models\OrderDetailModel();
                $OrderDetail->order_id = $orderId;
                $OrderDetail->multi_ticket_id = $MultiTicket->id;
                $OrderDetail->status = _ORDER_STATUS_SUCCESSFUL_;
                $OrderDetail->price_paid = $MultiTicket->price * 100;
                $OrderDetail->guid = str_random( _PASSWORD_RESET_TOKEN_LENGTH_ );

                $OrderDetail->save();
                Log::info('Multi product SAVED: '.  json_encode($OrderDetail));
               
        }
         
        
    }

    public static function processAndSaveSingleProducts( $orderId, $single ) {
        
        if ( !$single || !count($single) || !$orderId ) {
            Log::info('In processAndSaveSingleProducts: Missing data: OrderId: '.$orderId.', Products Count: '.count($single));
            return false;
        }
        
        foreach($single as $item) {
            
            for($i=1; $i<=$item['qty']; $i++) {

                $Product = \App\Models\ProductModel::find($item['id']);

                $OrderDetail = new \App\Models\OrderDetailModel();
                $OrderDetail->order_id = $orderId;
                $OrderDetail->single_ticket_id = $Product->singleTicket->id;
                $OrderDetail->status = _ORDER_STATUS_SUCCESSFUL_;
                $OrderDetail->price_paid = $Product->singleTicket->price * 100;
                $OrderDetail->guid = str_random( _PASSWORD_RESET_TOKEN_LENGTH_ );

                $OrderDetail->save();
                Log::info('Single product SAVED: '.  json_encode($OrderDetail));
                
            }            
            
        }
        
    }

    public static function paymentDetailsFailed() {
        
        //
        // Define custom messages.
        $messages = [
            'order_card_holder.required'=>'Please provide Card Holder\'s Name.',
            'order_card_holder.string'=>'Card Holder\'s Name must be a string.',
            'order_card_holder.max'=>'Card Holder\'s Name exceed maximum length allowed.',
            'order_card_number.required'=>'Please provide Card Number.',
            'order_card_number.numeric'=>'Card Number must be number.',
            'order_card_number.digits_between'=>'Card Number is not valid.',
            'order_card_expiry_month.required'=>'Please select Expiry Date.',
            'order_card_expiry_year.required'=>'Please select Expiry Date.',
            'order_card_security.required'=>'Please provide Card Security Code.',
            'order_card_security.numeric'=>'Card Security Code must be a number.',
            'order_card_security.digits_between'=>'Card Security Code is not valid.',
        ];        
        
        //
        // Set validation rules
        $rules = array(
            'order_card_holder' => 'required|string|max:100',
            'order_card_number' => 'required|numeric|digits_between:13,16',
            'order_card_expiry_month' => 'required|numeric',
            'order_card_expiry_year' => 'required|numeric',
            'order_card_security' => 'required|numeric|digits_between:3,4',
        );

        //
        // Apply validation rules
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        return $validator;
        
    }
        
}