<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Ticket;
use App\Providers\TicketUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TicketUpdatedListener
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
     * @param  TicketUpdated  $event
     * @return void
     */
    public function handle(TicketUpdated $event)
    {
        Activity::query()->create([
            'description' => 'updated',
            'user_id' => auth()->id(),
            'subject_id' => $event->ticket->id,
            'subject_type' => Ticket::class,
        ]);

        // send notification
    }
}
