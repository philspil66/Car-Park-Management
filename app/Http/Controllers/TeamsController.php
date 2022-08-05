<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\EstController;
use App\Models\TeamModel;
use App\Models\TeamLangModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Classes\Category;
use App\Classes\Team;

class TeamsController extends EstController
{

    /**
     * For setting up add / edit team form
     *
     * @return void
     */

    public function addAmendForm() {

    	$teamId = Input::get('id');
    	$addAmendForm = array();

    	try {

    		if( $teamId ){	// edit

	    		$Team = TeamModel::find( $teamId );

	    		$addAmendForm['mode']        = 'Edit';
	    		$addAmendForm['teamId']		 = $Team->id;
                $addAmendForm['teamLogo']    = $Team->logo;
                $addAmendForm['teamStatus']  = $Team->status;   		
	    		$addAmendForm['teamName']	 = $Team->lang->name;
                $addAmendForm['categoryId']  = $Team->category->id;
                $addAmendForm['categories']  = Category::getCategories('team');

	    	}
	    	else { // add

	    		$addAmendForm['mode'] 		= 'Add';
                $addAmendForm['teamLogo']   = '';
                $addAmendForm['teamStatus'] = '';
                $addAmendForm['teamName']   = '';
                $addAmendForm['categoryId'] = '';
                $addAmendForm['categories'] = Category::getCategories('team');

	    	}

    	} catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Form (Teams). '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Form (Teams).');
            die($ex->getMessage());

        }

        return view('admin.teams.teams-add-edit', compact('addAmendForm'));

    }

    /**
     * Add / Edit a team
     *
     * @return void
     */

     public function addAmendTeam(){

        $validator = Team::validateAddEditTeamInput( Input::all() );
        
        if ( $validator->fails() ) {

            return Redirect::back()->withInput()->withErrors($validator);

        }

        try {

            $teamId = Input::get('team_id');
            
            if( $teamId ){  // edit team

                $Team               = TeamModel::find( $teamId );
                $Team->lang->name   = Input::get('team_name');
                $Team->category_id  = Input::get('team_category'); 
                $Team->logo         = Input::get('team_logo');
                $Team->status       = Input::get('team_status');

                $Team->save();
                $Team->lang->save();

                Session::flash('success', 'Team has been updated successfully.');
                return Redirect::to('/admin/teams');

            }
            else { // add team

                $Team               = new TeamModel();
                $Team->category_id  = Input::get('team_category');
                $Team->logo         = Input::get('team_logo');
                $Team->status       = Input::get('team_status');
                $Team->save();

                $TeamLang           = new TeamLangModel();
                $TeamLang->team_id  = $Team->id;
                $TeamLang->name     = Input::get('team_name');
                $TeamLang->save();

                Session::flash('success', 'Team has been added successfully.');
                return Redirect::to('/admin/teams');

            }

        } catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Team. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Team.');
            die($ex->getMessage());

        }

     }
    
}
