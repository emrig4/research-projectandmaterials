<?php

namespace Modules\Contact\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Modules\Files\Entities\Files;

class contactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request )
    {
        $this->contact = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = url();
        return $this->view('emails.contact.contact')
                    ->subject('Contact Message | projectandmaterials.com')
                    // ->attach($this->emailAttachment['file'], [
                    //      'as' => $this->emailAttachment['name'],
                    //      'mime' => $this->emailAttachment['mime'],
                    // ])
                    ->with([
                        'ebook' => $this->contact,
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
