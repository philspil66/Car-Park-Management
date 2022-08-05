<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\EventLangModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\EstController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Classes\Tools;
use App\Classes\Event;
use App\Classes\Team;
use App\Classes\Category;


class EventsController extends EstController
{
    protected $Event;
    protected $numberOfCarParksStats;
    protected $totalCapacity;
    protected $totalAllocated;
    protected $totalWastage;
    protected $singleTicketsStats; 
    protected $multiTicketsStats;
    protected $guestListsStats;
    protected $forDoughnut;



    public function index() {
        return redirect::to('/admin/events/event-carparks/?id=' .Input::get('id'));
    }
    
    public function getUpcoming() {

        $events = EventModel::where('date', '>=', date('Y-m-d'))
                ->where('status', _STATUS_ACTIVE_)
                ->orderBy('date', 'asc')
                ->whereHas('products', function($query) { $query->where('products.status', _STATUS_ONLINE_); })
                ->get();

        /*
        $events = Event::getAllSingleEventsForFrontEnd();
        
        echo '<pre>';
        print_r($events);
        echo '</pre>';
        */
 		return view('site.events', compact('events'));
    }

    public function getOne($id) {

        $event = Event::loadAnEvent($id);
    	return view('site.events-details', compact('event'));

    }

    /**
     * Description
     *
     * @return void
     */
    public function listAll() {
        
        //
        // If Filter exists in the POST then set Session to that.
        // If Filter doesn't exist in the POST then:
        //      If Filter doesn't exist in the Session then set Session to Default value
        Session::put(_FILTER_TEXT_ORDER_BY_, 
                ( Input::has(_FILTER_TEXT_ORDER_BY_) ) 
                    ? Input::get(_FILTER_TEXT_ORDER_BY_) 
                    : ( !Session::has(_FILTER_TEXT_ORDER_BY_) ? _DEFAULT_FILTER_ORDER_BY_ : Session::get(_FILTER_TEXT_ORDER_BY_) ) );
        
        Session::put(_FILTER_TEXT_CAT_ID_, 
                ( Input::has(_FILTER_TEXT_CAT_ID_) ) 
                    ? Input::get(_FILTER_TEXT_CAT_ID_) 
                    : ( !Session::has(_FILTER_TEXT_CAT_ID_) ? _DEFAULT_FILTER_CAT_ID_ : Session::get(_FILTER_TEXT_CAT_ID_) ) );
        
        Session::put(_FILTER_TEXT_STATUS_, 
                ( Input::has(_FILTER_TEXT_STATUS_) ) 
                    ? Input::get(_FILTER_TEXT_STATUS_) 
                    : ( !Session::has(_FILTER_TEXT_STATUS_) ? _DEFAULT_FILTER_STATUS_ : Session::get(_FILTER_TEXT_STATUS_) ) );
        
        Session::put(_FILTER_TEXT_INC_OLD_, 
                ( Input::has(_FILTER_TEXT_INC_OLD_) ) 
                    ? Input::get(_FILTER_TEXT_INC_OLD_) 
                    : ( Input::has('submit') ) 
                            ? _DEFAULT_FILTER_INC_OLD_ 
                            : ( !Session::has(_FILTER_TEXT_INC_OLD_) ? _DEFAULT_FILTER_INC_OLD_ : Session::get(_FILTER_TEXT_INC_OLD_) ) );

        //
        // For Show Old Events checkbox.
        // If Form is submitted and checkbox ticked then Set to ticked otherwise set to default.
        // If Form isn't submitted AND tickbox is set in the Session then reset it to the Session otherwise set to default.
        Session::put( _FILTER_TEXT_INC_OLD_,
                ( Input::has('submit') )
                    ? (( Input::has(_FILTER_TEXT_INC_OLD_) )
                        ? Input::get(_FILTER_TEXT_INC_OLD_)
                        : _DEFAULT_FILTER_INC_OLD_ )
                    : ( ( Session::has(_FILTER_TEXT_INC_OLD_) )
                        ? Session::get(_FILTER_TEXT_INC_OLD_)
                        : _DEFAULT_FILTER_INC_OLD_ ) );
        
        //
        // Gathers all filter fields and their values
        $fields = array(
            _FILTER_TEXT_ORDER_BY_ => Session::get(_FILTER_TEXT_ORDER_BY_)
            , _FILTER_TEXT_CAT_ID_ => Session::get(_FILTER_TEXT_CAT_ID_)
            , _FILTER_TEXT_STATUS_ => Session::get(_FILTER_TEXT_STATUS_)
            , _FILTER_TEXT_INC_OLD_ => Session::get(_FILTER_TEXT_INC_OLD_)
        );    
        
        $events = Event::loadAllEvents(Session::get(_FILTER_TEXT_ORDER_BY_), Session::get(_FILTER_TEXT_CAT_ID_), Session::get(_FILTER_TEXT_STATUS_), Session::get(_FILTER_TEXT_INC_OLD_));
        
        $pagination = $this->setPagination( $events );
        
        $orderBy = Tools::getOrderByForEvents();
        $status = Tools::getStatusesForEvents();
        $Categories = \App\Models\CategoryModel::orderBy('slug')->get();

        $allocatedBar = Event::figuresForAllocatedBar($events);

        return view('admin.events', compact('events', 'fields', 'pagination', 'orderBy', 'status', 'Categories', 'allocatedBar'));
                
    }
    
    /**
     * This method sets numbers for pagination.
     *
     * @param \App\Classes\Event $events Collection of Event objects
     * @return array
     */
    public function setPagination( $events ) {
        
        $startRecord = ($events->total()) ? 1 : $events->total();
        if ($events->currentPage() > 1) {
            $startRecord = ($events->perPage() * ($events->currentPage()-1)) + 1;
        }
        $endRecord = $events->perPage() * $events->currentPage();
        $endRecord = ($events->total() > $endRecord) ? $endRecord : $events->total();

        $pagination['startRecord'] = $startRecord;
        $pagination['endRecord'] = $endRecord;

        return array(
            'startRecord' => $startRecord,
            'endRecord' => $endRecord
        );
    }
    
    /**
     * Add a car park to an event.
     *
     * @return void
     */
    public function addAmendCarPark() {
        
        $retMessage = array( 'status' => 1, 'message' => '' );     
        $message = 'Car park successfully added.';
        
        $validator = \App\Classes\CarPark::validateAddCarParkInput( Input::all() );
        
        $duplicate = \App\Classes\CarPark::carParkExists((INT)Input::get('product_car_park_id'), (INT)Input::get('product_event_id'));

        if ( $validator->fails() || $duplicate ) {

            if ( $duplicate ) {
                $validator->getMessageBag()->add('CarParkExists', 'Selected car park already linked with this event.');
            }
            
            $retMessage['status'] = 0;
            $retMessage['message'] = json_encode($validator->errors()->all());
            return $retMessage;
        }
  
        if ( (INT)Input::get('product_id') ) {
            
            $Product = \App\Models\ProductModel::find(Input::get('product_id'));
            $SingleTicket = \App\Models\SingleTicketModel::where('product_id', $Product->id)->first();
            $message = 'Car park successfully updated.';
            
        } else {
            
            $Product = new \App\Models\ProductModel();
            $SingleTicket = new \App\Models\SingleTicketModel();
            $Product->event_id = Input::get('product_event_id');
            $Product->car_park_id = Input::get('product_car_park_id');
            $message = 'Car park successfully added.';
            
        }
        $Product->allocated = Input::get('product_allocated');
        $Product->opening_time = Input::get('product_open');
        $Product->closing_time = Input::get('product_close');
        $Product->status = Input::get('product_status');
        
        try {
            
            $Product->save();
            
            $SingleTicket->product_id = $Product->id;
            $SingleTicket->price = Input::get('product_price');
            $SingleTicket->save();
            
        } catch (\Exception $ex) {
            
            \Log::info('Error while adding car park to event. '.$ex->getMessage());
            $retMessage['status'] = 0;
            $retMessage['message'] = json_encode( array('text'=>'Error while adding car park to event.'));
            return $retMessage;
            
        }
        
        Session::flash('successCarPark', $message);
        $retMessage['status'] = 1;
        $retMessage['message'] = json_encode( array('text'=>$message));

        return $retMessage;
//        die();
        
        
        /*
        $validator = \App\Classes\CarPark::validateAddCarParkInput( Input::all() );
        
        if ( $validator->fails() ) {
            return Redirect::back()->withInput()->withErrors($validator, 'carpark');
        }
        
        
        
        if ( (INT)Input::get('product_id') ) {
            
            $Product = \App\Models\ProductModel::find(Input::get('product_id'));
            $SingleTicket = \App\Models\SingleTicketModel::where('product_id', $Product->id);
            
        } else {
            
            $Product = new \App\Models\ProductModel();
            $SingleTicket = new \App\Models\SingleTicketModel();
            
        }
        
        $Product->event_id = Input::get('product_event_id');
        $Product->car_park_id = Input::get('product_car_park_id');
        $Product->allocated = Input::get('product_allocated');
        $Product->opening_time = Input::get('product_open');
        $Product->closing_time = Input::get('product_close');
        $Product->status = Input::get('product_status');
        
        try {
            
            $Product->save();
            
            $SingleTicket->product_id = $Product->id;
            $SingleTicket->price = Input::get('product_price');
            $SingleTicket->save();
            
        } catch (\Exception $ex) {
            
            \Log::info('Error while adding car park to event. '.$ex->getMessage());
            Session::flash('errorCarPark', 'Error while adding car park to event.');
            
        }
        
        Session::flash('successCarPark', 'Car park successfully added.');
        return Redirect::to('/admin/events/event-carparks/?id='.$Product->event_id);
        
         * 
         */
    }
    
    /**
     * Loads all car parks and related data/stats for a given event into a view.
     *
     * @return void
     */
    public function loadAllCarparksForAnEvent() {
        
        $eventMgmt = array();
        $eventStats = array();
        
        try {
            
        
            // Grab EventId from the URL and fetch Event object
            $eventId        = Input::get( 'id' );
            if ( !$eventId ) {

                die(' No Event Id provided, return to previous page with error message');
            }
            
            $this->Event    = \App\Models\EventModel::find( $eventId );
            
            // Grab all car park objects for the given Event OR prime the response for creating a new event
            $eventMgmt['event'] = \App\Classes\Event::loadEventAttributes( $this->Event, (INT)Input::get( 'cid' ) );
            $eventMgmt['products']       = \App\Classes\Product::getAllProductsForAnEvent($this->Event );
            $eventMgmt['carParks'] = \App\Classes\CarPark::getAllCarParks();
            
            // This function must be called before assinging variables below.
            $this->calculateStats();
            $eventStats['numberOfCarParksStats']  = $this->numberOfCarParksStats;
            $eventStats['capacityStats']          = $this->totalCapacity;
            $eventStats['allocatedStats']         = $this->totalAllocated;
            $eventStats['singleTicketsStats']     = $this->singleTicketsStats;
            $eventStats['wastageStats']           = $this->totalWastage;
            $eventStats['multiTicketsStats']      = $this->multiTicketsStats;
            $eventStats['guestListsStats']        = $this->guestListsStats;
            $eventStats['forDoughnut']            = $this->forDoughnut;

            $eventMgmt['stats'] = $eventStats;
            
            // If EventId exists but can't fetch the Event object then show a message
            if ( $eventId && !$this->Event ) {
                Session::flash('error', 'No such event found.');
            }
            
        } catch (\Exception $ex) {

            \Log::info('Error while loading event information. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error while loading event information.');
            die($ex->getMessage());
        }

        return view('admin.event-management', compact('eventMgmt')); 
        
    }
    
    /**
     * Calculates all the stats for the Car Park tab on Event Management screen.
     *
     * @return void
     */
    public function calculateStats() {
    /*
     *  Calculate stats for all car parks linked to an event
     */    
        
        $stats = new \App\Classes\Stats($this->Event);
        
        
        
        
        /*
         * Calculate number of total car parks
         */
        $this->numberOfCarParksStats = $stats->numberOfCarParks();
            
            
        /*
         * Calculate:
         *  - total capacity
         *  - total allocated
         *  - total wastage
         */            
        $capacityAndAllocated = $stats->capacityAndAllocated();
        $this->totalCapacity = $capacityAndAllocated['capacity'];
        $this->totalAllocated = $capacityAndAllocated['allocated'];
        $this->totalWastage = $stats->wastageStats(); 

        /*
         * Single tickets stats 
         */
        $this->singleTicketsStats = $stats->singleTicketsStats();
        
        /*
         * Multi tickets stats 
         */
        $this->multiTicketsStats = $stats->multiTicketsStats();
                        
        /*
         * Guest lists stats 
         */
        $this->guestListsStats = $stats->guestListsStats();

        /*
         * Calculate usage for doughnut chart
         * +++ This must be called after all other stats to ensure values are calculated correctly +++
         */
        $this->forDoughnut = $stats->calculateDoughnutValues();
        
    }


    /**
     * Create / Edit Form (e.g. for creating or editing and event)
     *
     * @return void
     */
    public function createEditForm() {

        $eventId        = Input::get( 'id' );
        $categoryId     = Input::get( 'category_id' );
        $createEditForm = array();

        try {
           
            if( !$eventId && !$categoryId){
                die('No event id or category_id has been provided.');
            }

            // If event id is provided form is in edit mode
            if( $eventId ){

                // get the event from db
                $event = DB::table('events')
                        ->leftJoin('events_lang', 'events.id', '=', 'events_lang.event_id')
                        ->leftJoin('categories', 'events.category_id', '=', 'categories.id')
                        ->leftJoin('categories_lang', 'categories.id', '=', 'categories_lang.category_id')
                        ->leftJoin('teams as team1', 'team1.id', '=', 'events.team1_id')
                        ->leftJoin('teams_lang as teamsLang1','teamsLang1.team_id','=','team1.id')
                        ->leftJoin('teams as team2', 'team2.id', '=', 'events.team2_id')
                        ->leftJoin('teams_lang as teamsLang2','teamsLang2.team_id','=','team2.id')
                        ->select(   'events.*',
                                    'events_lang.*',
                                    'categories.type as categoryType',
                                    'categories_lang.description as categoryName',
                                    'teamsLang1.name as team1name',
                                    'teamsLang2.name as team2name'
                                )
                        ->where('events.id', $eventId)
                        ->get();

                $createEditForm['raw']            = $event;

                // set array variables for view from event data
                $createEditForm['mode']           = 'Edit';
                $createEditForm['eventId']        = $eventId;
                $createEditForm['categoryType']   = $event[0]->categoryType;
                $createEditForm['categoryName']   = $event[0]->categoryName;
                $createEditForm['title']          = $event[0]->title;
                $createEditForm['date']           = $event[0]->date;                
                $createEditForm['time']           = date('H:i', strtotime($event[0]->time));
                $createEditForm['vanityDate']     = Tools::dateformat( $event[0]->date );
                $createEditForm['vanityTime']     = Tools::timeformat( $event[0]->time );
                $createEditForm['status']         = $event[0]->status;
                $createEditForm['description']    = $event[0]->description;
                $createEditForm['team1']          = $event[0]->team1name;
                $createEditForm['team2']          = $event[0]->team2name;

                // if the category type is team, retrieve the teams for the category
                if( $event[0]->categoryType == 'team' ){

                    $teams = Team::getTeamsByCategory( $event[0]->category_id );
                    $createEditForm['teams'] = $teams;

                }

            }

            // Else if category id is provided form is in create mode
            else if( $categoryId ){

                $createEditForm['mode']         = 'Create';
                $createEditForm['categoryId']   = $categoryId;
                $createEditForm['categoryType'] = Category::getCategoryType( $categoryId );
                $createEditForm['categoryName'] = Category::getCategoryName( $categoryId );
                $createEditForm['title']        = '';
                $createEditForm['date']         = '';
                $createEditForm['time']         = '';
                $createEditForm['status']       = 'inactive';
                $createEditForm['description']  = '';
                $createEditForm['teams']        = Team::getTeamsByCategory( $categoryId );
                $createEditForm['team1']        = '';
                $createEditForm['team2']        = '';

            }

        } catch (\Exception $ex) {

            \Log::info('Error in Create/Edit event. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
            Session::flash('error', 'Error in Create/Edit event.');
            die($ex->getMessage());
        }

        return view('admin.event-create-edit', compact('createEditForm')); 

    }

    /**
     * Create / Edit and Event
     *
     * @return void
     */
    public function createEditEvent(){

        $validator = \App\Classes\Event::validateCreateEditEventInput( Input::all() );

        if ( $validator->fails() ) {

            return Redirect::back()->withInput()->withErrors($validator);

        }

        if( Input::get('mode') == 'Edit' ) {   

            try {

                // get the event using the eventId
                $eventId = Input::get('event_id');
                $Event = EventModel::find( $eventId );

                // update event details
                $Event->lang->title         = Input::get('event_title');
                $Event->date                = Input::get('event_date');
                $Event->time                = Input::get('event_time');
                $Event->status              = Input::get('event_status');
                $Event->lang->description   = Input::get('event_description');

                if( Input::get('event_team1_id') && Input::get('event_team2_id') ){
                    $Event->team1_id        = Input::get('event_team1_id');
                    $Event->team2_id        = Input::get('event_team2_id');
                }

                // save the updated event
                $Event->save();
                $Event->lang->save();

                Session::flash('success','Event has been updated successfully.');
                return Redirect::to('/admin/events');

            } catch (\Exception $ex) {

                \Log::info('Error while updating event. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
                Session::flash('error', 'Error while updating event.');
                return Redirect::back();

            }

        }
        else { // create event

            try {

                $Event = new EventModel();
                
                $Event->category_id     = Input::get('category_id');
                $Event->team1_id        = Input::get('event_team1_id') ? Input::get('event_team1_id') : 0;
                $Event->team2_id        = Input::get('event_team2_id') ? Input::get('event_team2_id') : 0;
                $Event->date            = Input::get('event_date');
                $Event->time            = Input::get('event_time');
                $Event->status          = Input::get('event_status');
                $Event->save();     

                $EventLang = new EventLangModel();
                $EventLang->event_id    = $Event->id;
                $EventLang->title       = Input::get('event_title');
                $EventLang->description = Input::get('event_description');
                $EventLang->save();

                //Session::flash('success','Event has been created successfully.');
                return Redirect::to('/admin/events/event-carparks?id=' . $Event->id);

            } catch (\Exception $ex) {

                \Log::info('Error while creating event. '.__FILE__.' line '.__LINE__.' --> '.$ex->getMessage());
                Session::flash('error', 'Error while creating event.');
                return Redirect::back();

            }

        }

    }
    
}
