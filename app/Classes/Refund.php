<?php namespace App\Classes;

use Log;
use App\User;

class Refund extends StripeTransactions {
    
    protected $OrderDetail;    // OrderDetails object
    protected $Order;
    protected $Customer;    // User object

    public function __construct( $orderDetailId ) {
        // Get OrderDetail object
        $this->OrderDetail = \App\Models\OrderDetailModel::find( $orderDetailId );
        
        if ( $this->OrderDetail ) {
        // If OrderDetail object exists then get Order object otherwise create empty Order object
            
            $this->Order = \App\Models\OrderModel::find( $this->OrderDetail->order_id );
            
            if ( $this->Order ) {
            // If Order object exists then get Customer object otherwise create empty Customer object    
                $this->Customer = User::find( $this->Order->user_id );
            } else {
                
                $this->Customer = new User();
            }
        } else {
            
            $this->Order = new Order();
        }
        
    }

    private function refundChecksOk() {
    //
    // This method checks various conditions to see if a refund is allowed or not
    //
        
        //
        // Set a default return response
        $refundAllowed = array( 'status' => 0, 'message' => '' );

        //
        // Check current time (time of refund) in relations to event time - 
        // must be a diff of atleast set number of hrs 
        //
        $SingleTicket = $this->OrderDetail->singleTicket;
        $Event = $SingleTicket->Product->event;
        if ( $Event ) {
        //
        // If event exists...    
            
            if ( strtotime( $Event->date .' '. $Event->time ) > (time() + (_REFUND_BEFORE_IN_HRS_ * 60 * 60)) ) {
            //
            // Current time is more than ALLOWED HRS before the event, so allow    
            //    
                $refundAllowed['status'] = 1;
                
                
            } else {
            //
            // Current time is less than ALLOWED HRS before the event, so do not allow    
            //    
                $refundAllowed['status'] = 0;
                $refundAllowed['message'] = 'Too close to the event.';
                \Log::critical('Refund request failed, Too close to the event. Event (id='.$Event->id.') is at: '. 
                        $Event->date .' '. 
                        $Event->time .', Time now is: '.date("d-m-Y H:i:s"));
                return $refundAllowed;
                
                
            }
            
        } else {
        //
        // Can't find related event...
            
            $refundAllowed['status'] = 0;
            $refundAllowed['message'] = 'Event not found, please contact us.';
            \Log::critical('Refund request failed, Event not found, product object: '. json_encode($SingleTicket->Product) );
            return $refundAllowed;
        }
        
        //
        // Check if it's a single ticket.
        // products_id exists and is more than 0
        if ( ($SingleTicket->product_id) && (INT)($SingleTicket->product_id) ) {
            $refundAllowed['status'] = 1;
            
        } else {
            
            $refundAllowed['status'] = 0;
            $refundAllowed['message'] = 'Not allowed for season tickets.';
            \Log::critical('Refund request failed, this appears to be season ticket '. json_encode($this->OrderDetail) );
            return $refundAllowed;
        }
        
        
        //
        // Check if user requesting the refund is same as the user placed the order
        //
        if ( $this->Customer->id != \Auth::user()->id ) {
            
            $refundAllowed['status'] = 0;
            $refundAllowed['message'] = 'User Invalidated.';
            \Log::critical('Refund request failed, logged in users seems to be different from the customer placed the order. LoggedIn user id: '.\Auth::user()->id.', original customer id: '.$this->Customer-id);
            
            return $refundAllowed;
            
        } 
        
        
        //
        // Check if already been refunded
        //
        if ( $SingleTicket->status == _ORDER_STATUS_CANCELLED_ ) {
            
            $refundAllowed['status'] = 0;
            $refundAllowed['message'] = 'Already cancelled.';
            \Log::critical('Refund request failed, this booking is already canclled.');
            
            return $refundAllowed;
        } 
            
        return $refundAllowed;
    }
    
    public function requestRefund() {
    
    //
    // This method performs following tasks:
    // 1. Checks if refund is ALLOWED or not
    // 2. If ALLOWED then:
    //  a. Checks if status of related Order isn't anything other than SUCCESSFUL
    //  b. Check if related Order transaction_ref exists
    //  c. If above conditions are true then attempts a REFUND.
    //  d. If attempt succeedes then updates the ORDER_DETAIL status
    //  e. If attempt fails asks the user to contact office.
    // 3. If NOT ALLOWED then returns response received from refundChecksOk
    //    
        
        \Log::info( 'Refund requested:');
        
        
        //
        // Check if refund is allowed and log it.
        $refundStatus = $this->refundChecksOk();
        \Log::info( 'Result of refundCheck is: '.json_encode( $refundStatus ));
        
        
        
        if ( $refundStatus['status'] ) {
        //
        // If refund ALLOWED then ...
        //
            
            
            \Log::info('Refund check ok.');
            
            
            //
            // Make sure related Order status is SUCCESSFUL
            if ( $this->Order && $this->Order->status != _ORDER_STATUS_SUCCESSFUL_ ) {

                \Log::critical('Either related Order is missing or order status is not successful. Returning "Invalid order" error message back to the user. Heres order object:'. json_encode($this->Order));
                return array( 'status' => 0, 'message' => 'Invalid order.');
                
            }
            
            //
            // Make sure relate Order contains a valid transaction_ref
            if ( $this->Order && !strlen(trim($this->Order->transaction_ref)) ) {
                
                \Log::critical('Either related Order or order transaction is missing. Returning "Invalid transaction reference" error message back to the user. Heres order object:'. json_encode($this->Order));
                return array( 'status' => 0, 'message' => 'Invalid transaction reference.');
                
            }
            
            
            
            //
            // Attempt a refund and log the atempt            
            \Log::info('Attempting Stripe refund call with a private key length: '.strlen(_STRIPE_PRIVATE_KEY_)); 
            \Stripe\Stripe::setApiKey(_STRIPE_PRIVATE_KEY_);
            try {
                
                //
                // Make the call and log it. Log the response too.
                \Log::info('Trying refund with Stripe: Charge: '.$this->Order->transaction_ref.', Amount: '.$this->OrderDetail->price_paid ); 
           
                $re = \Stripe\Refund::create(array(
                    "charge" => $this->Order->transaction_ref
                   , "amount" => $this->OrderDetail->price_paid
                   , "reason" => _REFUND_REASON_CUSTOMER_REQ_
                ));                
                \Log::info('Stripe response: '.json_encode($re));
                
                
                
                
                //
                // Refund completed.
                // Update order_details and set the status correctly
                $this->OrderDetail->status = _ORDER_STATUS_CANCELLED_;
                $this->OrderDetail->save();

                
                
            } catch (\Stripe\Error\InvalidRequest $e) {
                
                $e_json = $e->getJsonBody();
                $err = $e_json['error'];
                \Log::critical('Refund request failed, customer is asked to contact us, error: '.  $err['message']);
                
            } catch (\Stripe\Error\Base $e) {
            
                $e_json = $e->getJsonBody();
                $err = $e_json['error'];
                \Log::critical('Refund request failed, customer is asked to contact us, error: '.  $err['message']);
                
            } catch (\Exception $e) {
                
                $e_json = $e->getJsonBody();
                $err = $e_json['error'];
                \Log::critical('Refund request failed, customer is asked to contact us, error: '.  $err['message']);
                
            }
            
            
            return array( 'status' => 1, 'message' => '' );                

        } else {
            
            //
            // If refund not allowed then return response received from 
            // the method that decided refund not allowed
            return $refundStatus;
        }
    }
    
        
}