<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\EstController;

class CleanDatabaseController extends EstController
{

    
    private $enabled = 1;
    
    public function index() {
    
        \Log::info('**********');
        \Log::info('Database Cleaning requested');
        
        if ( !$this->enabled ) {
            
            \Log::info('Cleaning database is disabled');
            die(' Cleaning database is disabled. ');
        }

//        \Log::info('Cleaning Users table:');
//        $this->cleanUsers();
        
        
    }
    
    public function cleanAddresses() {
        if ( !$this->enabled ) {
            
            \Log::info('Cleaning database is disabled');
            die(' Cleaning database is disabled. ');
        }
        
        \App\Models\AddressModel::chunk(500, function($Addresses)
        {
            foreach ($Addresses as $Address) {
  
                \Log::info('Before Change: '.json_encode($Address));
                
                $Address->address1 = $this->stripOuterSpaces($Address->address1);
                $Address->address2 = $this->stripOuterSpaces($Address->address2);
                $Address->town = $this->stripOuterSpaces($Address->town);
                $Address->county = $this->stripOuterSpaces($Address->county);
                $Address->country = $this->stripOuterSpaces($Address->country);
                $Address->postcode = $this->stripPostcodeSpaces($Address->postcode);
                
                $Address->save();
                \Log::info('After Change: '.json_encode($Address));
                
                echo '<br>Address processed: '.$Address->id.' - '.$Address->address1;
            }
        });

        
    }
    public function cleanUsers() {
        if ( !$this->enabled ) {
            
            \Log::info('Cleaning database is disabled');
            die(' Cleaning database is disabled. ');
        }
        
        $Users = \App\User::whereBetween('id', array(15000, 24000))->get();
        foreach ($Users as $User) {

            \Log::info('Before Change: '.json_encode($User));
            $User->firstname = $this->stripOuterSpaces($User->firstname);
            $User->lastname = $this->stripOuterSpaces($User->lastname);
            $User->telephone = $this->stripOuterSpaces($User->telephone);
            $User->email = $this->stripOuterSpaces($User->email);
            $User->save();
//                \Log::info('After Change: '.json_encode($User));

            echo '<br>User processed: '.$User->id.' - '.$User->getFullname();
        }
/*        
        \App\User::chunk(500, function($Users)
        {
            foreach ($Users as $User) {

                \Log::info('Before Change: '.json_encode($User));
                $User->firstname = $this->stripOuterSpaces($User->firstname);
                $User->lastname = $this->stripOuterSpaces($User->lastname);
                $User->telephone = $this->stripOuterSpaces($User->telephone);
                $User->email = $this->stripOuterSpaces($User->email);
                $User->save();
//                \Log::info('After Change: '.json_encode($User));
                
                echo '<br>User processed: '.$User->id.' - '.$User->getFullname();
            }
        });
          */  
    }

    public function cleanPlates() {

        if ( !$this->enabled ) {
            
            \Log::info('Cleaning database is disabled');
            die(' Cleaning database is disabled. ');
        }
        $Plates = \App\Models\PlateModel::whereBetween('id', array(18000, 28000))->get();
        
//        \App\Models\PlateModel::chunk(500, function($Plates)
//        {
            foreach ($Plates as $Plate) {

                \Log::info('Before Change: '.json_encode($Plate));
                $Plate->plate_number = $this->stripPlateSpaces($Plate->plate_number);
                $Plate->save();
//                \Log::info('After Change: '.json_encode($Plate));
                
                echo '<br>Plate processed: '.$Plate->id.' - '.$Plate->plate_number;
            }
            
//        });
            
    }
    
    private function stripPlateSpaces( $string ) {
        $string = \App\Classes\Tools::stripPlateSpaces($string);
        return trim( $this->stripHexSpace($string) );
    }
    private function stripOuterSpaces($string) {
        $search = array("\t", "\r", "\n", "Â");
        $string = str_replace($search, '', $string);
        
        return trim( $this->stripHexSpace($string) );
    }

    private function stripPostcodeSpaces($string) {
        
        $string = \App\Classes\Tools::stripPostcodeSpaces($string);        
        return strtoupper( trim( $this->stripHexSpace($string) ) );
    }
    
    private function stripHexSpace($string) {
        
        $hex = bin2hex($string);
        if (substr($hex, -4) == 'c2a0') {
            $hex = str_replace('c2a0', '', $hex);
            $string = hex2bin($hex);
        }
        
        return $string;
    }
    
 
}
