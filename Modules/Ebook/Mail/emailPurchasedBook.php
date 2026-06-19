<?php

namespace Modules\Ebook\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

class emailPurchasedBook extends Mailable
{
    use Queueable, SerializesModels;

    public $ebook;
    public $customer;
    private $emailAttachment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ebook, $customer, $emailAttachment)
    {
        $this->ebook = $ebook;
        $this->customer = $customer;
        $this->emailAttachment = $emailAttachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = url( "/ebooks/" . $this->ebook->slug );
        return $this->view('public.mails.ebook-purchase')
                    ->subject('Project and Materials')
                    ->attach($this->emailAttachment['file'], [
                         'as' => $this->emailAttachment['name'],
                         'mime' => $this->emailAttachment['mime'],
                    ])
                    ->with([
                        'ebook' => $this->ebook,
                        'price' => $this->ebook->price,
                        'currency' => $this->ebook->currency->code,
                        'email' => $this->customer->email,
                        'name' => $this->customer->name,
                        'date' => Carbon::now(),
                        'link' => $link,
                    ]);

        // dd($this->customer);
    }
}
