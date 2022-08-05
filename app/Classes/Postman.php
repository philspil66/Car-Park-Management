<?php namespace App\Classes;

use Log;
use App\User;
use App\Jobs\SendWeeklyReminder;
use App\Jobs\Send1DayReminder;
use App\Jobs\SendOnTheDayReminder;
use App\Jobs\SendOrderConfirmation;
use App\Jobs\SendPasswordReset;
use App\Jobs\SendRegistration;

use Illuminate\Foundation\Bus\DispatchesJobs;

class Postman extends EST {

    use DispatchesJobs;
    
    // Store receipient's email address
    protected $to;
    
    // Store firstname
    protected $receipientFirstname;
    
    // Store given token
    protected $token;
    
    protected $User;
    
    
    public function __construct( $User = null)
    {
        if ( $User ) {

            $this->User                 = $User;
            $this->to                   = $User->email;
            $this->receipientFirstname  = $User->firstname;            
            
        }
    }

    public function sendEmailFor1WeekReminder( $event ) {
        
        \Illuminate\Support\Facades\DB::reconnect();        
        \Log::info('Creating email reminder job for: '.$this->User->email);
        $job = new SendWeeklyReminder($this->User, $event);        
        dispatch( $job );                
        
        // Need to run this command before queue can be processed: php artisan queue:listen
         
        ////        $job = (new SendWeeklyReminder($this->User))->onQueue('emails');
    }

    public function sendEmailFor1DayReminder( $event ) {

        \Illuminate\Support\Facades\DB::reconnect();        
        \Log::info('Creating email reminder job for: '.$this->User->email);
        $job = new Send1DayReminder($this->User, $event);        
        dispatch( $job );                
        
    }
    
    public function sendEmailForOnTheDayReminder( $event ) {
        
        \Illuminate\Support\Facades\DB::reconnect();        
        \Log::info('Creating email reminder job for: '.$this->User->email);
        $job = new SendOnTheDayReminder($this->User, $event);        
        dispatch( $job );                
        
    }

    /**
     * This method sends out an email when a new order is placed.
     *
     * @return boolean
     */
    public function sendEmailForOrderConfirmation( $orderId ) {

        \Illuminate\Support\Facades\DB::reconnect();        
        \Log::info('Creating Order Confirmation email for: '.$this->User->email);
        try {
            $job = new SendOrderConfirmation($this->User, $orderId);        
            dispatch( $job );                
        } catch(\Exception $ex) {
            
            \Log::error('Creating Order Confirmation email failed for: '.$this->User->email);
            return false;
        }
        return true;
        
    }
    
    
    /**
     * This method sends out an email when a new user registers on the site.
     *
     * @return boolean
     */
    public function sendEmailForRegistration() {
        
        \Illuminate\Support\Facades\DB::reconnect();        
        \Log::info('Creating Account Registration email for: '.$this->User->email);
        try {
            $job = new SendRegistration($this->User);        
            dispatch( $job );                
        } catch(\Exception $ex) {
            
            \Log::error('Creating Account Registration email failed for: '.$this->User->email);
            return false;
        }

        return true;
        
    }
    
    /**
     * This method sends out an email when a new user requests password reset.
     *
     * @return boolean
     */
    public function sendEmailForPasswordReset() {
        
        \Illuminate\Support\Facades\DB::reconnect();        
        \Log::info('Creating Password Reset email for: '.$this->User->email);
        try {
            $job = new SendPasswordReset($this->User);        
            dispatch( $job );                
        } catch(\Exception $ex) {
            
            \Log::error('Creating Password Reset email failed for: '.$this->User->email);
            return false;
        }

        return true;
        
    }
    
    /**
     * A generic send email method.
     *
     * @return boolean
     */
    private function sendEmail( $data ) {
        
        if ( !(BOOL)strlen(trim($data['email']))) {
            Log::error('Send email requested but not email supplied.');            
            return false;
        }
        
        Log::info('Send email requested with email: '.$data['email']);
        
        // Send email
        $sent = \Mail::send($data['template'], $data, function($message) use ($data) {
                $message->from(_EMAIL_GENERIC_FROM_EMAIL_, $data['site_name']);
                $message->subject($data['site_name'].' '.$data['subject']);
                $message->to($data['email']);
        });
            
        if ( $sent ) {
            Log::info('Email sent to: '.$data['email']);
            
        } else {
            
            Log::error('Failed to send email to: '.$data['email']);
        }   
            
        return (BOOL)$sent;
    }
        
}