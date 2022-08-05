<?php 

namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Validator;

class WastageReason extends EST {

    /**
     * Validates input fields for Add / Edit Wastage Reason form.
     *
     * @param  Array $input Form Fields
     * @return Validator object
     */
    public static function validateAddEditWastageReasonInput( $input ) {
        
        //
        // Customise attributes names for display.
        $customAttributes = array(
            'wastage_reason_desc' => 'Description'
        );
        
        //
        // Define custom messages.
        $messages = array(
            'wastage_reason_desc.string' => 'Name is not valid',
            'wastage_reason_desc.min' => 'Name must be at least 2 characters'
        );        
        
        //
        // Set validation rules
        $rules = array(
            'wastage_reason_desc' => 'required|string|min:2|max:255'
        );
        
        // Apply validation rules
        return Validator::make($input, $rules, $messages, $customAttributes);

    }

}