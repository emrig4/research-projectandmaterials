<?php

namespace Modules\Ebook\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EbookPurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     /**
     * The ebook entity.
     *
     * @var \Modules\Ebook\Entities\Ebook
     */
    public $ebook;

     /**
     * The customer entity.
     *
     * @var \Modules\Ebook\Entities\Ebook
     */
    public $customer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ebook, $customer)
    {
        $this->ebook = $ebook;
        $this->customer = $customer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
