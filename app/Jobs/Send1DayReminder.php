<?php

namespace App\Jobs;

use Log;
use App\Jobs\EstJob;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Send1DayReminder extends EstJob implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data = array();
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\User $User, $event)
    {

        $this->User = $User;
        $this->data['subject']                = '- Information Required';
        $this->data['firstname']              = $User->getFullname();
        $this->data['site_name']              = _SITE_NAME_;
        $this->data['email']                    = $User->email; 
        $this->data['account_link']             = _ACCOUNT_URL_;
        
        $this->data['event']                    = $event['eventTitle'];
        $this->data['event_date']               = \App\Classes\Tools::dateformat($event['eventDate']).' '.\App\Classes\Tools::timeformat($event['eventTime']);

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
                    _TEMPLATES_1DAY_REMINDER_
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
