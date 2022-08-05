<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\EstController;
use Illuminate\Support\Facades\Input;

class OrderController extends EstController
{
    public static function loadOrderComplete() {

        $Order = \App\Models\OrderModel::where('order_ref', Input::get('order'))->where('user_id', \Auth::user()->id)->first();
        if ( $Order ) {
            $User = \Auth::user();
            $basketContents = \App\Classes\Order::getOrderDetails( $Order );
            
            \App\Classes\Basket::discardBasket();

            if ( $Order->type != 'phone') {
                $confirmationEmail = new \App\Classes\Postman($User);
                $confirmationEmail->sendEmailForOrderConfirmation($Order->id);
            }
            return view('site.checkout.checkout-completed', compact('User', 'Order', 'basketContents'));
        }
    }
    
    public function viewOrderDetails() {
        $id = Input::get('order_id');
        $orderDetails = array();
        if ( $id ) {
            
            $Order = \App\Models\OrderModel::find( $id );                        
            $Address = $Order->Address;
            $User = $Order->User;
            
            
            $orderDetails['orderId'] = $Order->id;
            $orderDetails['orderRef'] = $Order->order_ref;
            $orderDetails['orderTransaction'] = $Order->transaction_ref;
            $orderDetails['orderDate'] = \App\Classes\Tools::dateformat( $Order->created_at );
            $orderDetails['orderTime'] = \App\Classes\Tools::timeformat( $Order->created_at );
            $orderDetails['fullName'] = $User->getFullname();
            $orderDetails['address'] = ( strlen(trim($Address->address1))?trim($Address->address1):'' );
            $orderDetails['address'] .= ( strlen(trim($Address->address2))?trim(', '.$Address->address2):'' );
            $orderDetails['address'] .= ( strlen(trim($Address->town))?trim(', '.$Address->town):'' );
            $orderDetails['address'] .= ( strlen(trim($Address->county))?trim(', '.$Address->county):'' );
            $orderDetails['address'] .= ( strlen(trim($Address->country))?trim(', '.$Address->country):'' );
            $orderDetails['address'] .= ( strlen(trim($Address->postcode))?trim(', '.$Address->postcode):'' );
            $orderDetails['email'] = $User->email;
            $orderDetails['userId'] = $User->id;
            $order_details = \App\Classes\Order::getOrderDetailsForManagement($Order);
            $orderDetails['details'] = $order_details['orderDetails'];
            $orderDetails['orderTotal'] = $order_details['orderTotal'];
            $orderDetails['telephone'] = $User->telephone;
            
        }
        
        return view('admin.orders-view', compact('orderDetails'));
    }
    
    public function saveEmail() {
        
        $user_id = Input::get('user_id');
        $new_email = Input::get('new_email');
        
        $ret = 2;
        if ( $user_id && strlen($new_email) ) {
            
            $User = \App\User::find( $user_id );
            $User->email = $new_email;
            $ret = (INT) $User->save();
            
        }
        
        echo $ret;
        
    }
}
