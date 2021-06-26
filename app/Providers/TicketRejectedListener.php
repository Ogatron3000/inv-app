<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Ticket;
use App\Providers\TicketRejected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TicketRejectedListener
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
     * @param  TicketRejected  $event
     * @return void
     */
    public function handle(TicketRejected $event)
    {
        Activity::query()->create([
            'description' => 'rejected',
            'user_id' => auth()->id(),
            'subject_id' => $event->ticket->id,
            'subject_type' => Ticket::class,
        ]);

        // send notification
    }
}
