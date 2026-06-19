<?php

namespace Modules\Service\Listeners;

use Modules\Service\Events\ServiceRequestedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Service\Mail\serviceRequestedMail;

class SendMailOnServiceRequest
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  ServiceRequestedEvent  $event
     * @return void
     */
    public function handle(ServiceRequestedEvent $event)
    {
        $request = $event->request;
        
        try {

            // Construct file attachement here
            $emailAttachment = [];

            Mail::to($request->contact_email)
             ->cc([setting('site_email'), setting('contact_email')])
             ->send(new serviceRequestedMail($request, $emailAttachment));
        } catch (\Exception $e) {
            // dd($e);
        }
    }
}
