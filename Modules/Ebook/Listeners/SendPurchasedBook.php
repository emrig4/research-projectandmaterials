<?php

namespace Modules\Ebook\Listeners;

use Modules\Ebook\Events\EbookPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Modules\Ebook\Mail\emailPurchasedBook;

class SendPurchasedBook
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EbookPurchased  $event
     * @return void
     */
    public function handle(EbookPurchased $event)
    {
        $ebook = $event->ebook;
        $customer = $event->customer;
        
        try {

             $emailAttachment = [];

             // Construct file attachement here
            if(is_null($ebook->main_file_type))  {
                if(!is_null($ebook->main_file_url)) {
                    $ebook->main_file_type='external_link';
                }
            }
            
            if($ebook->main_file_type == 'external_link')
            {   

                // get all info about external file such as, ext, dir, basename, filename
                $externalFileInfo = pathinfo($ebook->main_file_url);

                $emailAttachment['file'] = $ebook->main_file_url;
                $emailAttachment['mime'] =  \GuzzleHttp\Psr7\mimetype_from_filename($ebook->main_file_url);
                // set attached external file name to match ebook slug
                $emailAttachment['name'] = $ebook->slug . '.' . $externalFileInfo['extension'];
                
            }elseif ($ebook->main_file_type == 'upload') {
                $emailAttachment['file'] = $ebook->main_book_file->path;
                $emailAttachment['mime'] = $ebook->main_book_file->mime;
                $emailAttachment['name'] = $ebook->slug . '.' . $ebook->main_book_file->extension;
            }


            Mail::to($customer->email)->send(new emailPurchasedBook($ebook, $customer, $emailAttachment));
        } catch (\Exception $e) {
            // dd($e);
        }
    }
}
