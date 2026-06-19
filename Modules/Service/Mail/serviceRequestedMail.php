<?php

namespace Modules\Service\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Modules\Files\Entities\Files;

class serviceRequestedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $service;
    private $emailAttachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $emailAttachment = null)
    {
        $this->request = $request;
        $this->service = $request->service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = url( "/services/" . $this->service->slug );
        return $this->view('emails.service.service_request2')
                    ->subject('Service Request | projectandmaterials.com')
                    // ->attach($this->emailAttachment['file'], [
                    //      'as' => $this->emailAttachment['name'],
                    //      'mime' => $this->emailAttachment['mime'],
                    // ])
                    ->with([
                        'ebook' => $this->request,
                        'date' => Carbon::now(),
                        'link' => $link,
                        'headerLogo' => $this->getHeaderLogo(),
                        'copyright' => setting('cynoebook_copyright_text'),
                    ]);

        // dd($this->customer);
    }

    private function getHeaderLogo()
    {
        return $this->getLogo('cynoebook_header_logo');
    }

    private function getLogo($key)
    {
        return Files::findOrNew(setting($key))->path;
    }
}
