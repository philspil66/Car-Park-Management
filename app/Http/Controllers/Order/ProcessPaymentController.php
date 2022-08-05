<?php

namespace App\Http\Controllers\Order;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\EstController;

class ProcessPaymentController extends EstController
{
    public function processPaymentForm() {
        
        if ( !\App\Classes\Basket::basketExists() ) {
            
                Session::flash('error', 'No pending order.');
                return \Redirect::back();
        }

        //
        // If payment validation fails, user is taken to the prev page.
        $validator = \App\Classes\Order::paymentDetailsFailed();
        if ( $validator->fails() ) {
            
            return \Redirect::back()->withInput()->withErrors($validator);
            
        } 


        \Log::info( 'Processing Payment Form.');      
        //
        // Make a call to stripe
        
        $orderRef = \App\Classes\Order::generateUniqueOrderRef();
        //************************
        // ONLY AFTER a successful response come back from stripe
        $stripeResponse = self::makeStripeCall( $orderRef );
        $Order = null;
        if ( (BOOL) $stripeResponse['status'] ) {
            
            //
            // Payment process successful
            //
            $transactionId = '';
            $responseReturnedFromStripe = $stripeResponse['response'];
            if ( $responseReturnedFromStripe['status'] == _STRIPE_RESPONSE_SUCCEEDED_ || $responseReturnedFromStripe['status'] == _STRIPE_RESPONSE_PAID_ ) {
                $transactionId = $responseReturnedFromStripe['id'];
            }
            \Log::info( 'Payment has gone through, attempting to save order details.');      
            $Order = \App\Classes\Order::saveOrder( $orderRef, $transactionId );
            if ( !$Order ) {
                
                \Log::critical( 'Payment has gone through but unable to save order details: '.  json_encode($Order));      
                Session::flash('error', 'Unable to save order information, please try again or contact us if problem persists.');
                return \Redirect::back()->withInput();
            } 
            
        } else {
            
            //
            // Payment process FAILED
            //
            Session::flash('error', 'Payment rejected: '.$stripeResponse['message']);
            return \Redirect::back()->withInput();
        }
  
        return \Redirect::to('/checkout/order-complete?order='.$Order->order_ref);        

    }
    
    public static function makeStripeCall( $orderRef ) {
        
        \Log::info( 'Preparing to make Stripe call.');      
        
        $arrReturn = array('status' => 0, 'code' => '', 'message' => '');        
        $stripeToken = '';
        
	// Need a payment token:
        if ( Input::has(_STRIPE_TOKEN_NAME_) && Input::get(_STRIPE_TOKEN_NAME_) ) {
            
            
            
            
            $stripToken = Input::get(_STRIPE_TOKEN_NAME_);            
            \Log::info( 'We have a Stripe payment token: '.$stripToken);                  
            // Check for a duplicate submission, just in case:
            if ( Session::has(_STRIPE_TOKEN_NAME_) && Session::get(_STRIPE_TOKEN_NAME_) == $stripToken ) {
                
                
                \Log::info( 'Duplicate submission attempted.');                
                $arrReturn['code'] = _STRIPE_ERROR_1_;
                return $arrReturn;
                
                
            } else { // New submission.
                
                
                \Log::info( 'New submission detected.');      
                Session::set(_STRIPE_TOKEN_NAME_, $stripToken);
                
                
            }
            
            
            
            
	} else {
            
            \Log::info( 'No valid Stripe payment token found.');      
            return $arrReturn;
	}
        
        
        try {

            
            $amount = \App\Classes\Basket::getBasketTotalValueAsPence();
            if ( !(BOOL)$amount || is_float($amount) ) {
                
                \Log::critical( 'Total order value is '.$amount.', this should be more than 0 and in whole pence. Aborting payment process.');                
                Session::flash('error', 'Something appears to be wrong, please click on the BASKET across the top of the page and start the process again.');
                return \Redirect::back()->withInput();
                
            }
            
            \Log::info( 'Attempting Stripe charge call with a private key length: '.strlen(_STRIPE_PRIVATE_KEY_));   
            if (strlen(trim(_STRIPE_PRIVATE_KEY_)) == 0) {
                \Log::critical('Missing Stripe private key');
                throw new Exception('Payment process not configured properly.');
            }
            \Stripe\Stripe::setApiKey(_STRIPE_PRIVATE_KEY_);

            $Address = \Auth::user()->Address;
            
            $paymentParameters = array(
                    "amount"                  => $amount                        // amount in PENCE, 1099 for £10.99
                    , "currency"              => _CURRENCY_
                    , "source"                => $stripToken
                    , "statement_descriptor"  => _STRIPE_STATEMENT_DESCRIPTOR_  // 22 char statement description eg Ricoh Arena Parking
                    , "description"           => $orderRef                  // order_ref 
                );
            
            \Log::info( 'Attempting Stripe charge call with parameters: '.  json_encode($paymentParameters));                  
            // Charge the order:
            $charge = \Stripe\Charge::create( $paymentParameters );

            
//            \Log::info( 'After the Stripe charge call: '.  json_encode($charge));      
            
            // Check that it was paid:
            if ($charge->paid == true) {

                
                \Log::info( 'Stripe charge call was successful.');      
                
                $arrReturn['status'] = 1;
                $arrReturn['response'] = $charge;
                return $arrReturn;
                    // Store the order in the database.
                    // Send the email.
                    // Celebrate!

                
            } else { // Charge was not paid!
                
                
                \Log::info( 'Stripe charge call was NOT successful: '.  json_encode($charge));      
                $arrReturn['message'] = 'Payment failed.';
                
                
            }
            
        } catch (\Stripe\Error\Card $e) {
            
            // Card was declined
            $e_json = $e->getJsonBody();
            $err = $e_json['error'];
            \Log::critical('\Stripe\Error\Card - Payment Error: Card Declined - '.$err['message']);
            \Log::critical('Error bag - '.  json_encode($e_json));
            $arrReturn['message'] = $err['message'];

        } catch (\Stripe\Error\Base $e) {
            
            \Log::critical('\Stripe\Error\Base - Payment Error: '.$e->getMessage());
            $arrReturn['message'] = $e->getMessage();
                
        } catch (\Exception $e) {
            
            \Log::critical('\Exception - Payment Error: '.$e->getMessage());
            $arrReturn['message'] = 'Error processing payment.';
                
        }
        return $arrReturn;
    }
}
