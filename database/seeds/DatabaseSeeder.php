<?php

/*
 * Database Seeder 2.0
 */

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Load all the static data vid SQL imports
        $this->loadSQL();
 
        // Scrape all dynamic data
        //$this->mineData();
     }
    
    /**
     * Load all the SQL imports.
     *
     * @return void
     */
    private function loadSQL()
    {        
         // Load Languages
        $sql = file_get_contents(dirname(__DIR__) . '/sql/languages.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
        
        // Load Roles
        $sql = file_get_contents(dirname(__DIR__) . '/sql/roles.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
        
         // Load Admin Users
        $sql = file_get_contents(dirname(__DIR__) . '/sql/users_admin.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }

        // Load Uest List Users
        $sql = file_get_contents(dirname(__DIR__) . '/sql/users_guestlist.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }        
        
        // Load Categories
        $sql = file_get_contents(dirname(__DIR__) . '/sql/categories.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }      
        
        // Load Teams
        $sql = file_get_contents(dirname(__DIR__) . '/sql/teams.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }    
        
        
        // Load Car Parks
        $sql = file_get_contents(dirname(__DIR__) . '/sql/car_parks.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }  
        
        // Load Multi Tickets
        $sql = file_get_contents(dirname(__DIR__) . '/sql/multi_tickets.sql');
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $stmt) {
            DB::statement($stmt);
        } 
        
 
    }
    
     /**
     * Do the data mines on dynamic data.
     *
     * @return void
     */
    private function mineData()
    {  

        // set userAgent to firefox browser
        $userAgent = 'IE 7 � Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)';        
        $login_url = 'https://secure.ricoharenaparking.co.uk/admin/members/login/class:form-control';
 
        //These are the post data fields
        $post_data = 'data[_Token][key]=b0e33e5e73dd354892ec17ff033e98557b4f91b1'
                   . '&data[Member][email]=test@capuk.eu'
                   . '&data[Member][password]=radford1'
                   . '&data[Member][remember_me]=1'
                   . '&data[Member][return_to]='
                   . '&data[_Token][fields]=bb29ffb9d4fc89af96d18bc479956bbef1d535d1%3AMember.return_to'
                   . '&data[_Token][unlocked]=';

        //Create a curl object
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
 
        //Set the login URL
        curl_setopt($ch, CURLOPT_URL, $login_url );
        curl_setopt($ch, CURLOPT_POST, 0 );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
 
        //Return the Page
        //$login_page = curl_exec($ch);       

        //Attempt login
        //$login_url = 'https://secure.ricoharenaparking.co.uk/admin/members/login/class:form-control';
        //curl_setopt($ch, CURLOPT_URL, $login_url );
        //curl_setopt($ch, CURLOPT_POST, 1 );
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        //$postResult = curl_exec($ch); 

        
        // Migrate Events/Products
        for ($x = 130; $x >= 0; $x--) {
            //echo $x;
            echo " CHECK FOR EVENT: ".$x;
            $event = DB::table('events')
                     ->where('orig_event_id', '=', $x)
                     ->first(['id','orig_event_id']); 
            
            print_r($event);
 
            if (isset($event)){
 
                $target_url = "https://secure.ricoharenaparking.co.uk/admin/events/edit/".$x;

                //echo "Reading: ".$target_url;
            
                curl_setopt($ch, CURLOPT_URL, $target_url);
                $html= curl_exec($ch);

                // if fail to grab page then report error
                if (!$html) {
                    echo " FAILED: ".$x;
                   //echo "Failed to grab event page";
	           //echo "<br />cURL error number:" .curl_errno($ch);
	           //echo "<br />cURL error:" . curl_error($ch);
	           //exit;
                }else{
                   //echo $html
                   echo " FOUND: ".$x;
                   $this->mineEventPage($html, $x); 
                }
            }

        }     
        
        
        // Migrate Orders/Order Detail/Users/Plates
        for ($x = 63000; $x >= 62000; $x--) {
            //echo $x;

            $order = DB::table('orders')
                     ->where('orig_order_id', '=', $x)
                     ->first(['id','orig_order_id']); 
            
            if (!isset($order)){
               // set url to scrape
               $target_url = "https://secure.ricoharenaparking.co.uk/admin/orders/view/".$x;

               //echo "Reading Order: ".$target_url;
            
               curl_setopt($ch, CURLOPT_URL, $target_url);
               $html= curl_exec($ch);

               // if fail to grab page then report error
               if (!$html) {
                   //echo "Failed to grab order page";
	           //echo "<br />cURL error number:" .curl_errno($ch);
	           //echo "<br />cURL error:" . curl_error($ch);
	           //exit;
               }else{
                    $this->mineOrderPage($html); 

               }
            }
        }     
        
    }  
    
    
     /**
     * Do the data mines on dynamic data.
     * Create PRODUCT, SINGLE_TICKET.
     * What about Multi-Tickets?
     *
     * @return void
     */
    private function mineEventPage($html, $event_id)
    { 
            echo " MINING EVENT: ".$event_id;
            $label_type = "";
            $event_title = "";
            $category_id = "";
            $team1 = "";
            $team2 = "";
            $multi_ticket_id = NULL;
            //$status = "";
            $car_parks = array();
            $car_park = array();

             // parse the html into a DOMDocument
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            
            
            // get all nodes
            $nodes = $dom->getElementsByTagName('*');
            
            // go through each node in web page
            foreach($nodes as $node)
            {
                if($node->nodeName == 'label')
                {
                    $label_type = $node->nodeValue;
                } 
                if($node->nodeName == 'select' && $node->getAttribute('name') === 'data[Event][team_1_id]')
                {
                    $team = 'team1';
                }                 
                
                // GET TITLE
                if($node->nodeName == 'h1')
                {
                    $event_title = str_replace("Edit Event - ", "", $node->nodeValue);
                }
                
                 // GET CATEGORY
                if ($node->nodeName === 'input' && $node->getAttribute('name') === 'data[Event][category_id]'){
                    $category_id = $node->getAttribute('value');
                }
                 
                // GET EVENT DESCRIPTION
                if($node->nodeName == 'textarea')
                {
                    $event_description = $node->nodeValue;
                }                
             
                // GET TEAM 1
                if ($node->nodeName === 'option' && $label_type === "Team 1" && $node->getAttribute('selected') === 'selected'){
                    $team1 = $this->fetchTeamID($node->nodeValue);
                    $label_type = "";
                } 
                
                // GET TEAM 2
                if ($node->nodeName === 'option' && $label_type === "Team 2" && $node->getAttribute('selected') === 'selected'){
                    $team2 = $this->fetchTeamID($node->nodeValue);
                    $label_type = "";
                }                 
                
                // GET EVENT DATE
                if ($node->nodeName === 'input' && $node->getAttribute('name') === 'data[Event][event_date]'){
                    $event_date = $node->getAttribute('value');
                }               
                
                // GET EVENT TIME
                if ($node->nodeName === 'input' && $node->getAttribute('name') === 'data[Event][event_time]'){
                    $event_time = $node->getAttribute('value');
                }                
                

                // CARPARK - NAME
                if($node->nodeName == 'h4')
                {
                    $car_park = $node->nodeValue;
                    $car_parks_id = $this->fetchCarParkID($car_park);
                    $car_park = array();
                    $car_park['car_parks_id'] = $car_parks_id;
                }                
                
                // CARKPARK - CAPACITY
                if ($node->nodeName === 'input' && substr($node->getAttribute('name'),-10) === '[capacity]'){
                    $car_park_capacity = $node->getAttribute('value');
                    $car_park['car_park_capacity'] = $car_park_capacity;
                }                
                 
                // CARKPAR - PRICE
                if ($node->nodeName === 'input' && substr($node->getAttribute('name'),-7) === '[price]'){
                    $car_park_price = $node->getAttribute('value');
                    $car_park['car_park_price'] = $car_park_price;
                }               
                
                // CARPARK - OPEN
                if ($node->nodeName === 'input' && substr($node->getAttribute('name'),-6) === '[open]'){
                    $car_park_open = $node->getAttribute('value');
                    $car_park['car_park_open'] = $car_park_open;
                }                
                
                // CARPARK - CLOSE
                if ($node->nodeName === 'input' && substr($node->getAttribute('name'),-7) === '[close]'){
                    $car_park_close = $node->getAttribute('value');
                    $car_park['car_park_close'] = $car_park_close;
                } 

                //TODO - SEASON TICKET
                if ($node->nodeName === 'option' && $label_type === "Season Ticket" && $node->getAttribute('selected') === 'selected'){
                    $multi_ticket_id = $this->fetchMultiTicketID($node->nodeValue);
                    $car_park['multi_ticket_id'] = $multi_ticket_id;
                    $car_park['multi_ticket'] = $node->nodeValue;
                    $label_type = "";
                }                

                //TODO - STATE    
                if ($node->nodeName === 'option' && $label_type === "State" && $node->getAttribute('selected') === 'selected'){
                    $car_park_state = $this->fetchState($node->getAttribute('value'));
                    $car_park['car_park_state'] = $car_park_state;
                    $car_parks[] = $car_park;
                    $label_type = "";
                }                 
                

                
            }

            if ($category_id != ""){
               // Check if event already exists
               $existing_event = DB::table('events')
                     ->where('orig_event_id', '=', $event_id)
                     ->first(['id']);              
               
               
               // CREATE NEW EVENT
               $date_upd = date('Y-m-d H:i:s');
               if (!isset($existing_event)){
                   echo "**NEW EVENT**";
                   //$date_upd = date('Y-m-d H:i:s');
                   $new_date = strtotime($event_date);
                   $event_date = date("Y-d-m", $new_date);
                   $event_time = date("H:i", strtotime($event_time));
            
                   // Create Event
                   $event_insert_id = DB::table('events')->insertGetId(
                       ['category_id'     => $category_id,
                        'team1'           => intval($team1),
                        'team2'           => intval($team2),
                        'orig_event_id'   => $event_id,
                        'date'            => $event_date,
                        'featured'        => false,   
                        'time'            => $event_time,
                        'status'          => 'active',                       
                        'created_at'      => $date_upd,
                        'updated_at'      => $date_upd]
                   ); 
                   // Create Event Lang 
                   $event_lang_insert_id = DB::table('events_lang')->insertGetId(
                       ['event_id'       => $event_insert_id,
                        'language_id'    => 1,
                        'title'           => trim($event_title),
                        'description'     => $event_description,                      
                        'created_at'      => $date_upd,
                        'updated_at'      => $date_upd]
                   );  
               }else{
                   echo "**DELETNG EXISTNG PRODUCTS**";
                   DB::delete('delete from products where event_id = ?', array($existing_event->id)); 
                   
                   $event_insert_id = $existing_event->id;
               }
               
   
            
            
            // Create PRODUCT / SINGLE_TICKET table
            foreach ($car_parks as $car_park) {

                
                if (isset($car_park['multi_ticket_id'])){
                    $multi_ticket_id = $car_park['multi_ticket_id'];
                }else{
                    $multi_ticket_id = NULL;  
                }
                // 
                if ($car_park['car_park_id'] != "0"){
                    
                   $product_id = 0;
                   $open_time = date("H:i", strtotime($car_park['car_park_open']));
                   $close_time = date("H:i", strtotime($car_park['car_park_close']));
                   
                   $product_insert_id = DB::table('products')->insertGetId(
                        ['event_id'     => $event_insert_id, 
                         'car_park_id'  => intVal($car_park['car_park_id']),  
                         'spaces'       => $car_park['car_park_capacity'],   
                         'price'        => ($car_park['car_park_price'] * 100),   
                         'opening_time' => $open_time,
                         'closing_time' => $close_time,   
                         'created_at'   => $date_upd,
                         'updated_at'   => $date_upd]
                   );  
                   
                   // TODO Create the Single Ticket
                   
                }                
                
            }            
            }

    }


    
    
     /**
     * Do the data mines on dynamic data.
     *
     * @return void
     */
    private function mineOrderPage($html)
    {             
            $label_type = "";
            $plate_number = "";
            $car_park_id = "";
            $status = "";
            $order_details = array();
            $order_detail = array();
            $ticket_type = "";
            $email = "";
            $first_name = "";
            $last_name = "";
             // parse the html into a DOMDocument
            $dom = new DOMDocument();
            @$dom->loadHTML($html);

 
            // get all nodes
            $nodes = $dom->getElementsByTagName('*');
            
            // go through each node in web page
            foreach($nodes as $node)
            {
                
                // Get order fields
                if($node->nodeName == 'th')
                {
                    $field_type = $node->nodeValue;
                }
                if($node->nodeName == 'td')
                {
                    $node_value = $node->nodeValue;

                    if ($field_type === "Id"){
                        $order_id = $node_value;
                        //echo " ORDER ID: ".$order_id;
                    } 
                    if ($field_type === "Order Ref"){
                        $order_ref = trim($node_value);
                    } 
                    if ($field_type === "Transaction Ref"){
                        $transaction_ref = trim($node_value);
                    } 
                    if ($field_type === "Status"){
                        $status = trim($node_value);
                    } 
                    if ($field_type === "Type"){
                        if ($node_value === "Guest"){
                            $user_type = "Guest";
                        }else if ($node_value === "Registered Member"){
                            $user_type = "Registered";
                        }
                    } 
                    if ($field_type === "Email"){
                        $email = str_replace("  Edit", "", $node_value);
                    }                     
                    if ($field_type === "Firstname"){
                        $first_name = $node_value;
                    }
                    if ($field_type === "Lastname"){
                        $last_name = $node_value;
                    }
                    if ($field_type === "Address 1"){
                        $address1 = $node_value;
                    }                   
                    if ($field_type === "Address 2"){
                        $address2 = $node_value;
                    }                     
                    if ($field_type === "City"){
                        $city = $node_value;
                    }                     
                    if ($field_type === "State"){
                        $state = $node_value;
                    } 
                    if ($field_type === "Post Code"){
                        $post_code = $node_value;
                    }
                    if ($field_type === "Country"){
                        $country = $node_value;
                    }
                    if ($field_type === "Created"){
                        $created = $node_value;
                    } 
                     if ($field_type === "Phone Number"){
                        $telephone = $node_value;
                    }                   

                }
                
                // Get label type
                if ($node->nodeName === 'label')
                {
                    $label_type = $node->nodeValue;
                }
                
                // Get Email Address
                //if ($node->getAttribute('class') == 'col-md-9' && $node->nodeName === 'p' && $label_type === ' Email '){
                //    $email_address = $node->nodeValue;
                //}
                
                // Get Joined Date
                if ($node->getAttribute('class') == 'col-md-9' && $node->nodeName === 'p' && $label_type === ' Joined '){
                    $joined = $node->nodeValue;
                } 
                
                 // Get event ID
                if ($node->nodeName === 'a' && $label_type === 'Event'){
                    //print_r($node);
                    $orig_event_id = str_replace("/", "", $node->getAttribute('href'));
                    $orig_event_id = strstr($orig_event_id, 'w');
                    $orig_event_id = str_replace("w", "", $orig_event_id);
                    $order_detail = array();
                   
                    $order_detail['event'] = $node->nodeValue;
                    $order_detail['event_id'] = $this->fetchOrigEventID($orig_event_id);
                    $order_detail['orig_event_id'] = $orig_event_id;
                    $order_detail['ticket_type'] = "event";
                    $ticket_type = "event";

                }   
                // Get Multi-ticket ID
                if ($node->getAttribute('class') == 'col-md-9' && $node->nodeName === 'div' && $label_type === 'Season'){
                    $multi_ticket = $node->nodeValue;
                    $multi_ticket_id = $this->fetchMultiTicketID($multi_ticket);
                    $order_detail = array();
                    $order_detail['multi_tickets_id'] = $multi_ticket_id;
                    $order_detail['ticket_type'] = "multi_ticket";
                    $ticket_type = "multi_ticket";
                }                
 
                // Get Car park
                if ($node->getAttribute('class') == 'col-md-9' && $node->nodeName === 'div' && $label_type === 'Car Park'){
                    $car_park = $node->nodeValue;
                    $car_parks_id = $this->fetchCarParkID($car_park);
                    $order_detail['car_park_id'] = $car_park_id;
                }
                
                 // Get Price
                if ($node->getAttribute('class') == 'col-md-9' && $node->nodeName === 'div' && $label_type === 'Price'){
                    $price_paid = $node->nodeValue;
                    $price_paid = str_replace("£", "", $price_paid);
                    $price_paid = str_replace(".", "", $price_paid);
                    $price_paid = str_replace(" ", "", $price_paid);
                    $price_paid = str_replace("&nbspRefund", "", $price_paid);
                    $order_detail['price_paid'] = trim($price_paid);
                }                
                 
                 // Get Plate
                if ($node->nodeName === 'span' && $label_type === 'Plate'){
                    $plate_number = $node->nodeValue;
                    $order_detail['plate_number'] = $plate_number;
                }  
                
                if ($label_type === 'Plate'){

                    
                }
                 if ($label_type === 'E-Ticket'){
                    // Package order Detail
                    $order_details[] = $order_detail;
                    //print_r($order_detail);
                    $label_type = "";
                    
                }               
                
                
            } // end of node loop

           //print_r($order_details);
           
            if ($email === ""){
                //echo "no email";
                return null;
            }
            if ($first_name  === "" && $last_name === ""){
                //echo "no user details";
                return null;
            }
            
            ///////////////////////////////////////////////////////	
            // Step One - Check if this user exists - check via 
            //            Email address
            //            If user does not exists then create user and address
            
            $user_id = NULL;
            $user = NULL;
            
            if ($email != ""){
             $user = DB::table('users')
                     ->where('email', '=', $email)
                     ->first(['id','addresses_id']);               
            }else{
                return null;
            }

            
            $user_insert_id = "";
            $address_insert_id = "";  
            $date_upd = date('Y-m-d H:i:s');
                   
            //print_r($user);
            //echo $first_name." ".$last_name;
            //echo "user: ".$user_id->id;
            
            if (empty($user)){
               //echo "Create User and Address";
                
               // Create Address First 
               // TODO - Get correct date created in
               $address_insert_id = DB::table('addresses')->insertGetId(
                   ['address1'     => $address1, 
                    'address2'     => $address2,
                    'town'         => $city,
                    'postcode'     => trim($post_code),
                    'county'       => $state,
                    'country'      => $country,
                    'status'       => 'Active',
                    'created_at'   => $date_upd,
                    'updated_at'   => $date_upd]
               );               
                  
               // Create User 
               // TODO - Get correct date created in
               $user_insert_id = DB::table('users')->insertGetId(
                   ['roles_id'     => 2, 
                    'addresses_id' => $address_insert_id,
                    'firstname'    => $first_name,
                    'lastname'     => $last_name,
                    'password'     => '',
                    'telephone'    => $telephone,
                    'email'        => trim($email),
                    'type'         => trim($user_type),
                    'status'       => 'Active',
                    'created_at'   => $date_upd,
                    'updated_at'   => $date_upd]
               ); 
               
            }else{
                //echo "exists: ";
                $user_insert_id = $user->id;
                $address_insert_id = $user->addresses_id;
                if ($address_insert_id === NULL){
                    return null; 
                }
            }
            
            
            //echo('TxnId: '.$transaction_ref);
            if (strlen($transaction_ref) > 0){
               //echo "***txnId is ok***";
            }else{
                $transaction_ref = "notfound_".rand(1,999999999);
                //echo "***txnId is NOT ok***";
            }
            
            //echo "Firstname: ".$first_name;
            //echo "Lastname: ".$last_name;
            //echo "(".$order_id.")";
            //echo "Status: ".$status;
            
            //$transaction_ref = "notfound_".rand(1,999999999);
            // Create Order
            // 
            // TODO - Get correct date created in
            // TODO - Type - Need to know if this a single or multi ticket ????????????

            $status2 = (string)$status;
            $order_insert_id = DB::table('orders')->insertGetId(
                   ['users_id'        => $user_insert_id,
                    'addresses_id'    => $address_insert_id,
                    'order_ref'       => trim($order_ref),                       
                    'transaction_ref' => trim($transaction_ref), 
                    'orig_order_id'   => intval($order_id),
                    'type'            => '',   
                    'status'          => trim($status2),                       
                    'created_at'      => $date_upd,
                    'updated_at'      => $date_upd]
            );
            echo "ORDER ID: ".$order_id;
            

            // TODO - Process array of order details

            //echo "ORDER_DETAILS LOOP";
            foreach ($order_details as $order) {
 
                //echo "order info:";
                print_r($order);

                // TODO: Check if Plate already exists for that user
                $plate_insert_id = 0;
                if (isset($order['plate_number']) || array_key_exists('plate_number', $order)) {
                    $plate_exists = $this->checkPlateExists($user_insert_id, $order['plate_number']);
                    if (!$plate_exists){
                       $plate_insert_id = DB::table('plates')->insertGetId(
                        ['users_id'     => $user_insert_id, 
                         'plate_number' => trim($order['plate_number']),
                         'created_at'   => $date_upd,
                         'updated_at'   => $date_upd]
                       );                   
                    }                
                    
                }
                
                $price_paid = intval($order['price_paid']);

                $product_id = null;
                if ($order['ticket_type'] === "event"){
                    $product_id = $this->fetchProductID($order['event_id'], $order['car_park_id']);
                    //echo "ProductID: ".$product_id;

                    $guid = str_random( 50 );
                    
                    // TODO - Get correct date created in
                    DB::table('order_details')->insert(
                        ['orders_id'        => $order_insert_id,
                         'products_id'      => $product_id, 
                         'multi_tickets_id' => NULL,
                         'plates_id'        => $plate_insert_id,                      
                         'checked_in'       => '',    
                         'price_paid'       => $price_paid,
                         'guid'             => $guid,   
                         'status'           => 'Successful',                           
                         'created_at'       => $date_upd,
                         'updated_at'       => $date_upd]
                    );                     
                    
                }else{
                    $guid = str_random( 50 );
                    //echo "MULTITCKET=".$order['multi_tickets_id'];
                    // TODO - Get correct date created in
                    DB::table('order_details')->insert(
                        ['orders_id'        => $order_insert_id,
                         'plates_id'        => $plate_insert_id,
                         'multi_tickets_id' => $order['multi_tickets_id'],                       
                         'checked_in'       => '',
                         'price_paid'       => $price_paid,
                         'guid'             => $guid, 
                         'status'           => 'Successful',
                         'created_at'       => $date_upd,
                         'updated_at'       => $date_upd]
                    );                     
                    
                    
                }
                

                
            }

            //echo $result;
    }
     
     /**
     * Do the data mines on dynamic data.
     *
     * @return car_park_id
     */
     private function fetchProductID($event, $car_park)
     {  
            //echo "find ProductID: ".$event." cp: ".$car_park;
            
            $result = DB::table('products')
                     ->where([
                         ['event_id', '=', $event],
                         ['car_park_id', '=', $car_park]
                            ])
                     ->first(['id']);

            if ($result){
                return $result->id;
            }else{
                return 0;
            }
      }
      
     /**
     * Do the data mines on dynamic data.
     *
     * @return car_park_id
     */
     private function fetchUserID($first, $last)
     {  
            
            $result = DB::table('users')
                     ->where([
                         ['firstname', '=', $first],
                         ['lastname', '=', $last]
                            ])
                     ->first(['id']);

            if ($result){
                return $result->id;
            }else{
                return 0;
            }
      }       
      
     /**
     * Finds Team ID
     *
     * @return teams_id
     */
     private function fetchTeamID($team)
     {  

            $result = DB::table('teams_lang')
                     ->where('name', '=', $team)
                     ->first(['team_id']);
            
            if ($result){
                return $result->team_id;
            }else{
                return 0;
            }
      } 

     /**
     * Finds Car park ID
     *
     * @return car_parks_id
     */
     private function fetchCarParkID($car_park)
     {  

            $result = DB::table('car_parks_lang')
                     ->where('name', '=', $car_park)
                     ->first(['car_park_id']);
            
            if ($result){
                return $result->car_park_id;
            }else{
                return 0;
            }
      } 
      
      /**
     * Finds State
     *
     * @return state
     */
     private function fetchState($state)
     {  

            if ($state === "1"){
                return "online";
            }
            if ($state === "2"){
                return "offline";
            }
            if ($state === "3"){
                return "private";
            }
            if ($state === "4"){
                return "deleted";
            }
            return "";            
            
      }       
      
      /**
     * Finds Multi ticket ID
     *
     * @return teams_id
     */
     private function fetchMultiTicketID($multi_ticket)
     {  
            $result = DB::table('multi_tickets_lang')
                     ->where('name', '=', $multi_ticket)
                     ->first(['multi_ticket_id']);
            
            if ($result){
                return $result->multi_tickets_id;
            }else{
                return 0;
            }
       } 
       
     /**
     * Finds Multi ticket ID
     *
     * @return teams_id
     */
     private function fetchCategoryID($category)
     {  
            $result = DB::table('category_lang')
                     ->where('description', '=', $category)
                     ->first(['category_id']);
            
            if ($result){
                return $result->category_id;
            }else{
                return 0;
            }
       }       
       
     /**
     * Finds Multi ticket ID
     *
     * @return teams_id
     */
     private function fetchEventID($event)
     {  
            $result = DB::table('events_lang')
                     ->where('title', '=', $event)
                     ->first(['event_id']);
            
            if ($result){
                return $result->event_id;
            }else{
                return 0;
            }
       }  

     /**
     * Finds Multi ticket ID
     *
     * @return teams_id
     */
     private function fetchOrigEventID($orig_event_id)
     {  
            $result = DB::table('events')
                     ->where('orig_event_id', '=', $orig_event_id)
                     ->first(['id', 'orig_event_id']);
            
            if ($result){
                return $result->id;
            }else{
                return 0;
            }
       }       
       
     /**
     * Check if plate exists for this user.
     *
     * @return boolean
     */
     private function checkPlateExists($user, $plate)
     {  
             $result = DB::table('plates')
                     ->where([
                         ['user_id', '=', $user],
                         ['plate_number', '=', $plate]
                            ])
                     ->first(['id']);

            if ($result){
                return true;
            }else{
                return false;
            }

      }       
       
     
    
}
