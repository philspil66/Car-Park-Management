<?php namespace App\Classes;

use Illuminate\Support\Facades\DB;

class Stats extends EST {
    
    protected $Event;
    protected $totalCapacity;
    protected $totalAllocated;
    protected $singleTicketsSold;
    protected $platesEntered;
    protected $wastage;
    protected $multiTicketsSold;
    protected $multiTicketsCheckedIn;
    protected $guestsSpaces;
    protected $guestsCheckedIn;


    public function __construct( $Event = null ) {
        if ( $Event ) {
            $this->Event = $Event;
        } else {
            $this->Event = new \App\Models\EventModel();
        }
    }

    /**
     * Returns Number of Car Parks stats array for the selected Event across all car parks.
     *
     * @return Array
     */
    public function numberOfCarParks() {
        
            return array(
                'stat' => count( $this->Event->products )
                , 'title' => '# of car parks'
                , 'description' => 'Total number for the event'
                , 'large' => 'true'
            );
    }
    
    /**
     * Returns Total Capacity and Total Allocated stats arrays for the selected Event across all car parks.
     *
     * @return Array
     */
    public function capacityAndAllocated() {
        
            $totals = self::calculateCapacityAndAllocated( $this->Event->id );

            $arr_return['capacity'] = array(
                'stat' => $totals['totalCapacity']
                , 'title' => 'Max capacity'
                , 'description' => 'Across all car parks'
                , 'large' => 'true'
            );
            $arr_return['allocated'] = array(
                'stat' => $totals['totalAllocated']
                , 'title' => 'Total allocated'
                , 'description' => 'Across all car parks'
                , 'large' => 'true'
            );

            return $arr_return;
    }
    
    /**
     * Calculates Total Capacity and Total Allocated for the selected Event across all car parks.
     *
     * @return void
     */
    public static function calculateCapacityAndAllocated( $eventId ) {
        
            $carParksForAnEvent = Event::carParksForAnEvent( $eventId );
            $totalAllocated = 0;
            $totalCapacity = 0;
            foreach($carParksForAnEvent as $carParkForAnEvent) {
                $totalAllocated += $carParkForAnEvent->allocated;
                $totalCapacity += $carParkForAnEvent->capacity;
            }
            
            return array(
                'totalAllocated' => $totalAllocated
                , 'totalCapacity' => $totalCapacity
            );
    }
    
    /**
     * Returns Single Tickets stats (Total Sold / Checked In) array for the selected Event across all car parks.
     *
     * @return Array
     */
    public function singleTicketsStats() {
        
            $this->singleTicketsSold = Event::singleTicketsSoldForAnEvent( $this->Event->id );
            $this->platesEntered = Event::platesEnteredForAnEvent( $this->Event->id );
            return array(
                'stat' => $this->singleTicketsSold.'/'.$this->platesEntered
                , 'title' => 'Sold / Plates Entered'
                , 'description' => 'Tickets sold for all car parks'
            );
    }
    
    /**
     * Returns number of wasted spaces array for the selected Event across all car parks.
     *
     * @return Array
     */
    public function wastageStats() {
        
            $this->wastage = Event::wastageForAnEvent( $this->Event->id );
            return array(
                'stat' => $this->wastage
                , 'title' => 'Wastage'
                , 'description' => 'For all car parks'
            );
    }
    
    /**
     * Returns Season Tickets stats (Total Sold / Checked In) array for the selected Event across all car parks.
     *
     * @return Array
     */
    public function multiTicketsStats() {
        
            $this->multiTicketsSold = Event::multiTicketsSoldForAnEvent( $this->Event->id );
            $this->multiTicketsCheckedIn = Event::multiTicketsCheckedInForAnEvent( $this->Event->id );
            return array(
                'stat' => $this->multiTicketsSold.'/'.$this->multiTicketsCheckedIn
                , 'title' => 'Sold / Plates entered'
                , 'description' => 'Season tickets sold for all car parks'
            );
    }
    
    /**
     * Returns Guest List stats (Total Spaces / Checked In) array for the selected Event across all car parks.
     *
     * @return Array
     */
    public function guestListsStats() {
        
            $this->guestsSpaces = Event::guestsSpacesForAnEvent( $this->Event->id );
            $this->guestsCheckedIn = Event::guestsCheckedInForAnEvent( $this->Event->id );
            return array(
                'stat' => $this->guestsSpaces.'/'.$this->guestsCheckedIn
                , 'title' => 'Spaces / Plates entered'
                , 'description' => 'Guest spaces for all car parks'
            );
    }

    /**
     * Returns stats array for the doughnut chart for selected Event across all car parks.
     *
     * @return Array
     */
    public function calculateDoughnutValues() {
        
        $totals = self::calculateCapacityAndAllocated( $this->Event->id);
            return array(
                'spacesLeft' => $this->singleTicketsSold + $this->wastage + $this->multiTicketsCheckedIn + $this->guestsCheckedIn
                , 'spacesTotal' => $totals['totalAllocated']
            );
    }
      
    public static function totalUsageForAnEvent( $eventId ) {
        
        $used = 0;
        $used += Event::singleTicketsSoldForAnEvent( $eventId );
        $used += Event::guestsSpacesForAnEvent( $eventId );
        $used += Event::multiTicketsSoldForAnEvent( $eventId );
        $used += Event::wastageForAnEvent( $eventId );
        
        return $used;
    }
}
