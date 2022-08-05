<?php

namespace App\Jobs;

use Log;
use App\Jobs\EstJob;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistration extends EstJob implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data = array();
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\User $User)
    {

        $token                = \App\Classes\Authenticate::generateGuidToken( $User );

        $this->data['template']               = 'site.emails.validate_access';
        $this->data['subject']                = 'Confirm Registration';
        $this->data['email']                  = $User->email;
        $this->data['firstname']              = $User->firstname;
        $this->data['site_name']              = _SITE_NAME_;
        $this->data['root_url']               = _ROOT_URL_;
        $this->data['email_link']    = _ROOT_URL_ . _LINK_VALIDATE_ACCESS_URL_ . '?token='.$token;
        
        if ( ! strlen( trim( $token ))) {
            Log::ciritcal('Trying to send registration confirmation email but token appears to be missing/invalide: '.$token.'. User email: '.  $User->email);            
            return false;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $Mailer)
    {
        $data = $this->data;
        
        // Send email
        $sent = $Mailer->send(
                    $data['template']
                    , $data
                    , function($message) use ($data) {
                        $message->from(
                                _EMAIL_GENERIC_FROM_EMAIL_
                                , $data['site_name']);
                        $message->subject($data['site_name'].' '.$data['subject']);
                        $message->to($data['email']);
        });
    }
}
