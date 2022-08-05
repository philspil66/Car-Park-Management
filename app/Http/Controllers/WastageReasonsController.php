<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\EstController;
use App\Models\WastageReasonModel;
use App\Models\WastageReasonLangModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Classes\WastageReason;

class WastageReasonsController extends EstController
{

    /**
     * For setting up add / edit team form
     *
     * @return void
     */

    public function addAmendForm() {

    	$wastageReasonId = Input::get('id');
    	$addAmendForm = array();

    	try {

    		if( $wastageReasonId ){	// edit

                $WastageReason = WastageReasonModel::find( $wastageReasonId );
                $addAmendForm['mode']               = 'Edit';
                $addAmendForm['wastageReasonId']    = $wastageReasonId;
                $addAmendForm['wastageReasonDesc']  = $WastageReason->lang->description;

	    	}
	    	else { // add

	    		$addAmendForm['mode'] 		         = 'Add';                
                $addAmendForm['wastageReasonDesc']   = '';

	    	}

    	} catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Form (Wastage Reasons). '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Form (Wastage Reasons).');
            die($ex->getMessage());

        }

        return view('admin.wastage-reasons.wastage-reasons-add-edit', compact('addAmendForm'));

    }

    /**
     * Add / Edit a team
     *
     * @return void
     */

     public function addAmendWastageReason(){

        $validator = WastageReason::validateAddEditWastageReasonInput( Input::all() );
        
        if ( $validator->fails() ) {

            return Redirect::back()->withInput()->withErrors($validator);

        }

        try {

            $wastageReasonId = Input::get('wastage_reason_id');
            
            if( $wastageReasonId ){  // edit wastage reason

                $WastageReason                      = WastageReasonModel::find( $wastageReasonId );
                $WastageReason->lang->description   = Input::get('wastage_reason_desc');

                $WastageReason->save();
                $WastageReason->lang->save();

                Session::flash('success', 'Wastage Reason has been updated successfully.');
                return Redirect::to('/admin/wastage-reasons');
                
            }
            else { // add team

                $WastageReason          = new WastageReasonModel();
                $WastageReason->save();

                $WastageReasonLang      = new WastageReasonLangModel();
                $WastageReasonLang->wastage_reason_id   = $WastageReason->id;
                $WastageReasonLang->description         = Input::get('wastage_reason_desc');
                $WastageReasonLang->save();

                Session::flash('success', 'Wastage Reason has been added successfully.');
                return Redirect::to('/admin/wastage-reasons');

            }

        } catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Wastage Reason. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Wastage Reason.');
            die($ex->getMessage());

        }

     }
    
}
