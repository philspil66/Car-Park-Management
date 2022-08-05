<?php namespace App\Classes;

use Log;
use App\User;

class Authenticate extends EST {
    
    protected $User;
    
    public function __construct( $User = null)
    {
        $this->User = $User;
    }
    
    /**
     * Checks if a given token is valid or not.
     *
     * @param  string  $token
     * @return boolean
     */
    public function tokenValid( $token ) {
        
        if ( !$this->User ) {
            return false;
        }
        
        if ( $this->User->remember_token ) {

            //
            // Token information is stored in two pieces, first 50 characters
            // are actual token following by 3 ||| acting as a seperator and 
            // finally number of seconds since 1970-01-01, generated through time()
            //

            
            $pieces = explode("|||", $this->User->remember_token);
            if ( count($pieces) == 2 ) {
                $tokenInDb = $pieces[0];
            } else {
                $tokenInDb = $this->User->remember_token;
            }
            
            return (BOOL) ( $token == $tokenInDb );
            
        }            
        
    }
    
    /**
     * Checks if a given token has expired or not.
     *
     * @param  string  $token
     * @return boolean
     */
    public function tokenExpired( $token ) {
        
        if ( !$this->User ) {
            return true;
        }
        
        if ( $this->User->remember_token ) {

            //
            // Token information is stored in two pieces, first 50 characters
            // are actual token following by 3 ||| acting as a seperator and 
            // finally number of seconds since 1970-01-01, generated through time()
            //

            $pieces = explode("|||", $this->User->remember_token);
            if ( count($pieces) == 2 ) {
                $timeStampInDb = $pieces[1];
            } else {
                return true;
            }
            
            // Add Reset valid period to the time token was generated
            $dbTokenExpiryTime = (_PASSWORD_RESET_TOKEN_LIFE_HRS_ * 60 * 60) + (INT)$timeStampInDb;

            return (BOOL) (time() > $dbTokenExpiryTime);

        }            
    }
    
    /**
     * Checks if a given token matches with the one in the db for the given user or not.
     *
     * @param  string  $token
     * @param  string  $type
     * @return boolean
     */
    public function tokenMatches( $token, $type ) {
        
        if ( $this->User->remember_token != $token ) {

            Log::critical($type.' requested and given reset token does not match with the one stored in our db. Given token: '.$token.', for user email: '.$this->User->email);

            //
            // Return back to view with error messages 
            $validator->errors()->add($token, 'Unable to validate some required information, please try again or contact us if problem persists.');                
            return Redirect::back()->withErrors($validator);

        }
    }
    
    /**
     * This method generates a token and saves it in the user record.
     *
     * @return boolean
     */
    public static function generateGuidToken( $User = null ) {
        
        if ( !$User ) {
            return '';
        }
            
        $token                  = str_random( _PASSWORD_RESET_TOKEN_LENGTH_ );
        $User->remember_token   = $token.'|||'.time();                
        $User->status           = _STATUS_INACTIVE_;
   
        $User->save();
        
        return $token;
    }
    
}