<?php

namespace Modules\Ebook\Listeners;

use Modules\Ebook\Events\EbookPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdmin
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
        //
    }
}
