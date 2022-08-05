<?php 

namespace App\Classes;
use DB;

class Tools {

	
	static function dateformat($date) { // e.g. Fri 1st Mar 2016

        $date = date('D jS \ M Y', strtotime($date));

    	return $date; 
    }

    /**
     * Strips spaces, tabs, newlines in all places from the given string.
     *
     * @param  String $string
     * @return String
     */
    public static function stripSpaces( $string ) {
        
        $search = array("\t", "\r", "\n", " ");
        $string = str_replace($search, '', trim($string));
        
        return $string;
        
    }
    
    /**
     * Strips spaces, tabs, newlines and dashes in all places from the given postcode.
     *
     * @param  String $string
     * @return String
     */
    public static function stripPostcodeSpaces( $postcode ) {
        
        $search = array('-', ' ');
        $replace = array('', '');
        
        return str_replace( $search, $replace, self::stripSpaces( $postcode ) );
    }
    
    /**
     * Strips spaces, tabs, newlines and dashes in all places from the given plate number.
     *
     * @param  String $string
     * @return String
     */
    public static function stripPlateSpaces( $plate ) {
        
        $search = array('-', ' ');
        $replace = array('', '');
        
        return str_replace( $search, $replace, self::stripSpaces( $plate ) );
    }
    
    /**
     * Strips hex character spaces in all places from the given string.
     *
     * @param  String $string
     * @return String
     */
    public static function stripHexSpace($string) {
        
        $hex = bin2hex($string);
        if (substr($hex, -4) == 'c2a0') {
            $hex = str_replace('c2a0', '', $hex);
            $string = hex2bin($hex);
        }
        
        return $string;
    }
    
    /**
     * Strips spaces, tabs, newlines and hex character spaces in all places from the given string.
     *
     * @param  String $string
     * @return String
     */
    public static function stripAllAndHexSpaces($string) {
        return self::stripSpaces( self::stripHexSpace($string) );
    }
    
    /**
     * Strips spaces, tabs, newlines and hex character spaces in all places from all attributes of the given Laravel Collection object.
     *
     * @param  Object $Obj
     * @return Object
     */
    public static function stripSpacesFromCollectionObject($Obj) {
        
        $arrObj = array();
        foreach($Obj as $k=>$v) {
            
            $arrObj[$k] = Tools::stripAllAndHexSpaces($v);
            
        }
        
        return (object)$arrObj;
    }
    public static function getOrderByForEvents() {
        
        $orderByEvents = explode(',', _ORDER_BY_EVENTS_);
        $orderBy = array();
        foreach($orderByEvents as $orderByEvent) {
            $orderBy[str_replace(' ', '', $orderByEvent)] = ucwords($orderByEvent);
        }
        
        return $orderBy;
    }
    
    public static function getStatusesForEvents() {
        
        $statusEvents = explode(',', _STATUSES_EVENTS_);
        $status = array();
        foreach($statusEvents as $statusEvent) {
            $status[str_replace(' ', '', $statusEvent)] = ucwords($statusEvent);
        }
        
        return $status;
        
    }
    
    static function timeformat($date) { // e.g. 12:00 AM

        $time = date('H:i A', strtotime($date));

        return $time;
    }

    static function capacity_single($product_id, $capacity) {
    	
    	$result = DB::table('order_details')
    	->join('orders', 'order_details.order_id', '=', 'orders.id')
    	->select(DB::raw('count(*) as order_details_count'))
    	->where('orders.status', 'like', 'Successful%')
    	->where('product_id', '=', $product_id)
    	->first();

    	if ($capacity == 0) $capacity = 1;

    	$used = $result->order_details_count;

    	$free = $capacity - $used;

    	$percentage = round($used / $capacity * 100);

    	if ($percentage < 80) $label = 'available';
    	if ($percentage >= 80) $label = 'limited';
    	if ($percentage >= 100) $label = 'sold';

    	$debug = 'capacity: '.$capacity.' - used: '.$used.' ('.$percentage.'%) - '.$label;
		
    	return $label;
    }

    static function capacity_multi($multi_ticket_id, $capacity) {
    	
    	$result = DB::table('order_details')
    	->join('orders', 'order_details.order_id', '=', 'orders.id')
    	->select(DB::raw('count(*) as order_details_count'))
    	->where('orders.status', 'like', 'Successful%')
    	->where('multi_ticket_id', '=', $multi_ticket_id)
    	->first();

    	if ($capacity == 0) $capacity = 1;

    	$used = $result->order_details_count;

    	$free = $capacity - $used;

    	$percentage = round($used / $capacity * 100);

    	if ($percentage < 80) $label = 'available';
    	if ($percentage >= 80) $label = 'limited';
    	if ($percentage >= 100) $label = 'sold';

    	$debug = 'capacity: '.$capacity.' - used: '.$used.' ('.$percentage.'%) - '.$label;
		
    	return $label;
    }

    public static function penceToPound( $pence, $with_currency_sign = false ) {

        $pence = (INT)$pence;       // Convert to INT, just in case.
        
        if ( $pence > 0 ) {
            $pence = $pence / 100;
        }
        
        
        if ( $with_currency_sign ) {
            return sprintf('£%0.2f', $pence);
        } else {
            return sprintf('%0.2f', $pence);
        }
        
    }

    static function calculate_percentage($n1, $n2){

        if ( $n2 == 0 ) {
            return 0;
        }
        
        $percentage = round(($n1 / $n2) * 100);
        return $percentage;

    }
 
    /*
    * This is coverts a csv file into an array
    */
    public static function csvToArray($file) {
        
        $rows = array();
        $cols = array();
        
        if (file_exists($file) && is_readable($file)){
            $handle = fopen($file, 'r');
            while (!feof($handle) ) {
                $row = fgetcsv($handle, 10240);
                if (empty($cols))
                   $cols = $row;
                else if(is_array($row)) {
                   $rows[] = array_combine($cols, $row);
                }
             }
             fclose($handle);
        } else {
            throw new Exception($file.' doesn`t exist or is not readable.');
        }
        return $rows;
    }   
    
    public static function isPhoneBooking($email) {
        
        return !( strpos($email, 'phone') === FALSE );
        
    }
    
    public static function generateRandomPassword( $length = 8 ) {
        
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*()?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
        
    }
    

}