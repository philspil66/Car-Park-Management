<?php

namespace App\Http\Controllers;

use Log;

use App\Models\CategoryModel;
use App\Models\CategoryLangModel;
use App\Models\MultiTicketGroupModel;
use App\Models\MultiTicketGroupLangModel;
use App\Models\MultiTicketModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Classes\Category;
use App\Classes\MultiTicket;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classes\Tools;

class MultiTicketsController extends EstController
{
    
    public function index() {
        return redirect::to('/admin/multi-tickets/carparks/?id=' .Input::get('id'));
    }   
    
    
    
    
    public function getUpcoming() {

    	$multi_tickets_group = MultiTicketGroupModel::where('status', _STATUS_MULTI_TICKET_ONLINE_)->get();
        return view('site.season-tickets', compact('multi_tickets_group'));
        
    }

    public function getDetails($id) {

        $multi_tickets = MultiTicket::getDetails($id);
    	return view('site.season-tickets-details', compact('multi_tickets'));
    }
    
    public function getOne($id) {

        //$event = Event::loadAnEvent($id);
    	//return view('site.events-details', compact('event'));

    }   
    
     /**
     * Description
     *
     * @return void
     */
    public function listAll() {
        
        Session::put(_FILTER_TEXT_STATUS_, 
                ( Input::has(_FILTER_TEXT_STATUS_) ) 
                    ? Input::get(_FILTER_TEXT_STATUS_) 
                    : ( !Session::has(_FILTER_TEXT_STATUS_) ? _DEFAULT_FILTER_STATUS_ : Session::get(_FILTER_TEXT_STATUS_) ) );
        
        //
        // Gathers all filter fields and their values
        $fields = array(
            _FILTER_TEXT_STATUS_ => Session::get(_FILTER_TEXT_STATUS_)
        );    
        
        $Categories = \App\Models\CategoryModel::all();
        
        $multi_ticket_groups = MultiTicket::loadAllMultiTickets(Session::get(_FILTER_TEXT_STATUS_));
        \Log::info('Controller: MultiTickets: '. count($multi_ticket_groups));
        $status = ""; //Tools::getStatusesForEvents();

        $allocatedBar = ""; //MultiTicket::figuresForAllocatedBar($events);
        \Log::info('Controller: MultiTickets - About to shift to View');
        return view('admin.multi-ticket.multi-ticket', compact('multi_ticket_groups', 'fields', 'status', 'Categories', 'allocatedBar'));
     } 
     
      /**
     * Description
     *
     * @return void
     */
    public function listAllCarParks() {
        
        
        $multiTicketMgmt = array();
        $multiTicketStats = array();
        
        try {
            
        
            // Grab MultiTicketId from the URL and fetch MultiTicket object
            $multiTicketId        = Input::get( 'id' );
            if ( !$multiTicketId ) {

                die(' No MultTicket Id provided, return to previous page with error message');
            }
            
            $this->MultiTicketGroup    = \App\Models\MultiTicketModel::find( $multiTicketId );
            
            // Grab all car park objects for the given MultiTicketGroup OR prime the response for creating a new multiticket
            //$multiTicketMgmt['multiticketgroup'] = \App\Classes\Event::loadEventAttributes( $this->MultiTicketGroup, (INT)Input::get( 'cid' ) );
            //$multiTicketMgmt['multitickets']     = \App\Classes\Product::getAllProductsForAnEvent($this->MultiTicketGroup );
            $multiTicketMgmt['carParks']         = \App\Classes\CarPark::getAllCarParks();
            
            // If EventId exists but can't fetch the Event object then show a message
            if ( $multiTicketId && !$this->MultiTicketGroup ) {
                Session::flash('error', 'No such multi ticket found.');
            }
            
        } catch (\Exception $ex) {

            \Log::info('Error while loading multi ticket information. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error while loading multi ticket information.');
            die($ex->getMessage());
        }

        return view('admin.multi-ticket.multi-ticket-carparks', compact('multiTicketMgmt'));     
        
         
        
        //return view('admin.multi-ticket.multi-ticket', compact('multi_ticket_groups', 'fields', 'status', 'Categories', 'allocatedBar'));
     } 
     
     /**
     * For setting up add / edit category form
     *
     * @return void
     */

    public function addAmendForm() {

    	$multiTicketId  = Input::get('id');
        $categoryId     = Input::get( 'category_id' );
    	$addAmendForm = array();

    	try {

                if( !$multiTicketId && !$categoryId){
                   // die('No multi ticket id or category_id has been provided.');
                }
                
                if  ($categoryId ){
                    $Category = CategoryModel::find( $categoryId);
                    if ($Category){
                        $addAmendForm['categoryName'] 	        = $Category->lang->description;
                    }else{
                        $addAmendForm['categoryName'] 	        = "";
                    }
                }else{
                    $addAmendForm['categoryName'] 	        = ""; 
                }               
            
    		if( $multiTicketId ){	// edit

	    		$MultiTicket = MultiTicketGroupModel::find( $multiTicketId);

                        $addAmendForm['mode'] 			        = 'Edit';
                        
                        if ($multiTicket){
 	    		   $addAmendForm['multiticketId']		= $MultiTicket->id;
                           $addAmendForm['status']		        = $MultiTicket->status;
                           $addAmendForm['categoryId']		        = $MultiTicket->category_id;
	    		   $addAmendForm['description'] 	        = $MultiTicket->lang->description;
                           $addAmendForm['name'] 	                = $MultiTicket->lang->name;                           
                        }else{
                           $addAmendForm['multiticketId']		= $multiTicketId;
                           $addAmendForm['status']		        = "";
                           $addAmendForm['categoryId']		        = "";
	    		   $addAmendForm['description'] 	        = "";
                           $addAmendForm['name'] 	                = ""; 
                        }


	    	}
	    	else { // add

	    		$addAmendForm['mode'] 			        = 'Add';
                        $addAmendForm['status']                         = 'offline';
                        $addAmendForm['categoryId']		        = $categoryId;
	    		//$addAmendForm['type'] 			= '';

	    	}

    	} catch (\Exception $ex) {

            \Log::info('Error in Add / Amend Form (Season Ticket). '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Form (Season Ticket).');
            die($ex->getMessage());

        }

        return view('admin.multi-ticket.multi-ticket-create-edit', compact('addAmendForm')); 

    }    

    /**
     * Create / Edit and Event
     *
     * @return void
     */
    public function createEditForm(){

        //$validator = \App\Classes\Event::validateCreateEditEventInput( Input::all() );

        //if ( $validator->fails() ) {

        //    return Redirect::back()->withInput()->withErrors($validator);

        //}

        if( Input::get('mode') == 'Edit' ) {   

            try {

               
                $multiTicketId = Input::get('multiTicket_id');
                $MultiTicket = MultiTicketGroupModel::find( $multiTicketId );

                // update multi ticket Group details
                $MultiTicket->lang->name          = Input::get('multiticket_name');
                $MultiTicket->status              = Input::get('multiticket_status');
                $MultiTicket->lang->description   = Input::get('multiticket_description');

                // save the updated multi ticket Group
                $MultiTicket->save();
                $MultiTicket->lang->save();

                Session::flash('success','MultiTicketGroup has been updated successfully.');
                return Redirect::back();

            } catch (\Exception $ex) {

                \Log::info('Error while updating MultiTicketGroup. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
                Session::flash('error', 'Error while updating MultiTicketGroup.');
                return Redirect::back();

            }

        }
        else { // create multi ticket Group

            try {

                $MultiTicket = new MultiTicketGroupModel();
                
                $MultiTicket->category_id     = Input::get('category_id');
                $MultiTicket->status          = Input::get('multiticket_status');
                $MultiTicket->save();     
                                      
                $MultiTicketLang = new MultiTicketGroupLangModel();
                $MultiTicketLang->multi_ticket_group_id    = $MultiTicket->id;
                $MultiTicketLang->name                     = Input::get('multiticket_name');
                $MultiTicketLang->description              = Input::get('multiticket_description');
                $MultiTicketLang->save();

                //Session::flash('success','MultiTicketGroup has been created successfully.');
                return Redirect::to('/admin/multi-tickets/carparks?id=' . $MultiTicket->id);

            } catch (\Exception $ex) {

                \Log::info('Error while creating MultiTicketGroup. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
                Session::flash('error', 'Error while creating MultiTicketGroup.');
                return Redirect::back();

            }

        }

    }     
    
    
    

}
