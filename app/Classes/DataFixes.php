<?php namespace App\Classes;

use Log;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataFixes extends EST {
    

    public static function removeInvalidPhoneNumbers() {
        
        Log::info('============================');
        Log::info('Removing Invalid Telephone Numbers');
 
        $phones = 0;
        $phones_fixed = 0;
        
        $users = self::getAllUsers();        
        foreach($users as $user) {
            
            $phones++;
            $phone = trim($user->telephone);

            if (strlen($phone) <= 11){
               $userDetail = \App\Models\UserModel::find($user->id);
                
               if ( $userDetail ) {
                   $phones_fixed++;
                   $userDetail->telephone = "";
                   $userDetail->save();
               }               
            }
            
            
            
        }      
        
        Log::info('Phones: '.$phones.' Phone Fixed: '.$phones_fixed);
        
        Log::info('============================');
    }
  
        public static function getAllUsers() {
        
        $users = DB::table('users')
                ->select('users.*')
                ->get();
        
        return $users;
    }

        
}