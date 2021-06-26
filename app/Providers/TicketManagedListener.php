<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Ticket;
use App\Providers\TicketManaged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TicketManagedListener
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
     * @param  TicketManaged  $event
     * @return void
     */
    public function handle(TicketManaged $event)
    {
        Activity::query()->create([
            'description' => 'managed',
            'user_id' => auth()->id(),
            'subject_id' => $event->ticket->id,
            'subject_type' => Ticket::class,
        ]);
    }
}
