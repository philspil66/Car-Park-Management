<?php

namespace App\Jobs;

use Log;
use App\Jobs\EstJob;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderConfirmation extends EstJob implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data = array();
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\User $User, $orderId)
    {

        $this->User = $User;
        
        
        $this->data['template']               = 'site.emails.order_confirmation';
        $this->data['subject']                = 'Booking Confirmation';
        $this->data['email']                  = $User->email;
        $this->data['firstname']              = $User->firstname;
        $this->data['site_name']              = _SITE_NAME_;
        $this->data['root_url']               = _ROOT_URL_;
        $this->data['account_link']           = _ACCOUNT_URL_;
        $this->data['carparks_link']          = _CAR_PARKS_URL_;

        //
        // Construct order summary
        $Order                                = \App\Models\OrderModel::find($orderId);
        $this->data['order_ref']              = $Order->order_ref;
        
        $details                              = \App\Classes\Order::getOrderDetails($Order);
        $this->data['total']                  = $details['orderTotal'];
        $this->data['order_details']          = $details['orderDetails'];
        
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
