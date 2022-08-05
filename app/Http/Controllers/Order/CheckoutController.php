<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\EstController;
use App\User;
use App\Models\AddressModel;
use Auth;
use DB;
use Log;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Classes\Order;
use App\Classes\Basket;
use App\Classes\Tools;


class CheckoutController extends EstController
{

    public function address_form() {

    	$user = Auth::user();

    	$user = User::find($user->id);

    	$address = AddressModel::where(['id' => $user->address_id, 'status' => 'active'])->first();

    	return view('site.checkout.checkout-details', compact('user', 'address'));
    }


    public function address_form_proccess(Request $request) {

        //
        // Set validation rules
        $rules = array(
            'address1' => 'required',
	        'postcode' => 'required',
	        'telephone' => 'required|min:11',
        );
        
        //
        // Apply validation rules
        $validator = Validator::make(Input::all(), $rules);

        if ( $validator->fails() ) {
            return Redirect::back()->withInput()->withErrors($validator);
        }        
        
        
    	//var_dump($request); die();

    	$user = Auth::user();

    	//var_dump($user); die();

    	$address = DB::table('addresses')
    	->select('id', 'address1', 'address2', 'town', 'postcode', 'county', 'country', 'status')
    	->where('id', '=', $user->address_id)
    	->where('status', '=', 'active')
    	->first();

    	//var_dump($address); die();

    
    	if (empty($address)) { // if address row doesn't exist insert it and join it to that user
/*
    		$insert_id = DB::table('addresses')
    		->insertGetId(['address1' => $request->address1, 'postcode' => $request->postcode]);
*/
                $NewAddress = new AddressModel();
                $NewAddress->address1  = $request->address1;
                $NewAddress->address2  = $request->address2;
                $NewAddress->town      = $request->town;
                $NewAddress->postcode  = Tools::stripPostcodeSpaces( $request->postcode );
                $NewAddress->county    = $request->county;
                $NewAddress->country   = $request->country;
                $NewAddress->status    = _STATUS_ACTIVE_;

                $NewAddress->save();
                
    		DB::table('users')->where('id', $user->id)
    		->update(['address_id' => $NewAddress->id]);

    	}
    	else { // if address row exist but new one has to be added

    		if ($address->address1 !== $request->address1 or $address->postcode !== Tools::stripPostcodeSpaces( $request->postcode )) { // if address1 or postcode are changed

//    			$insert_id = DB::table('addresses')
//    			->insertGetId(['address1' => $request->address1, 'postcode' => $request->postcode]); // insert new row

                        $NewAddress = new AddressModel();
                        $NewAddress->address1  = $request->address1;
                        $NewAddress->address2  = $request->address2;
                        $NewAddress->town      = $request->town;
                        $NewAddress->postcode  = Tools::stripPostcodeSpaces( $request->postcode );
                        $NewAddress->county    = $request->county;
                        $NewAddress->country   = $request->country;
                        $NewAddress->status    = _STATUS_ACTIVE_;

                        $NewAddress->save();
                    
    			DB::table('users')->where('id', $user->id)
    			->update(['address_id' => $NewAddress->id]); // join it to a user

    			DB::table('addresses')->where('id', $address->id)
    			->update(['status' => 'inactive']); // make old address inactive
    		}
    		
    	}
		// update other details
    	DB::table('users')->where('id', $user->id)
    	->update(['telephone' => $request->telephone]);
   
    	if (!isset($insert_id)) { $insert_id = $user->address_id; } // if no new address row will be inserted use the current one

        DB::table('addresses')
        ->where('id', '=', $insert_id)
        ->where('status', '=', 'active')
    	->update([
    	'address2' => $request->address2, 
    	'town' => $request->town, 
    	'county' => $request->county, 
    	'country' => $request->country]);

    	return redirect('checkout/payment');
    }

    /**
     * Loads and renders payment form 
     *
     * @return void
     */
    public function paymentForm() {
        
        $orderCompleted = !(INT)  Basket::basketExists();

        $User = \Auth::user();
        return view('site.checkout.checkout-payment', compact('User', 'orderCompleted'));
    }
            
}
