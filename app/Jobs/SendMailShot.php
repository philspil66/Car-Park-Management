<?php

namespace App\Jobs;

use Log;
use App\Jobs\EstJob;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailShot extends EstJob implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data = array();
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Event)
    {

        $this->data['subject']                = $Event->title.' - Parking Reminder';
        $this->data['firstname']              = ucwords( strtolower($Event->firstname));
        $this->data['site_name']              = _SITE_NAME_;
//        $this->data['email']                    = $Event->email; 
        $this->data['email']                    = 'ayyazz.hussain@estuk.co.uk'; 
        $this->data['account_link']             = _ACCOUNT_URL_;
        $this->data['plate_id']                 = (INT)$Event->plate_id;
        $this->data['event']                    = $Event->title;

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
                    _TEMPLATES_MAILSHOT_BS_
                    , $data
                    , function($message) use ($data) {
                        $message->from(
                                _EMAIL_GENERIC_FROM_EMAIL_
                                , $data['site_name']);
                        $message->subject($data['subject']);
                        $message->to($data['email']);
        });
        
    }
}
