<?php namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Validator;

class Team extends EST {

	/**
     * Returns teams for given category_id
     *
     * @param  $category_id
     * @return Obj
     */
    public static function getTeamsByCategory( $category_id ) {

    	$teams = DB::table('teams')
                    ->leftJoin('teams_lang', 'teams.id', '=', 'teams_lang.team_id')
                    ->select('teams.*', 'teams_lang.*')
                    ->where('teams.category_id', $category_id)
                    ->where('teams.status', 'active')
                    ->orderBy('name')
                    ->get();

        return $teams;

    }

    /**
     * Validates input fields for Add / Edit Team form.
     *
     * @param  Array $input Form Fields
     * @return Validator object
     */
    public static function validateAddEditTeamInput( $input ) {
        
        //
        // Customise attributes names for display.
        $customAttributes = array(
            'team_name' => 'Name',
            'team_logo' => 'Logo',
            'team_category' => 'Category',
            'team_status' => 'Status'
        );
        
        //
        // Define custom messages.
        $messages = array(
            'team_name.string' => 'Name is not valid',
            'team_name.min' => 'Name must be at least 2 characters',
            'team_logo.string' => 'Logo is not valid',
            'team_logo.min' => 'Logo must be at least 2 characters'
        );        
        
        //
        // Set validation rules
        $rules = array(
            'team_name' => 'required|string|min:2|max:255',
            'team_logo' => 'required|string|min:2|max:255',
            'team_category' => 'required',
            'team_status' => 'required'
        );
        
        // Apply validation rules
        return Validator::make($input, $rules, $messages, $customAttributes);

    }

}