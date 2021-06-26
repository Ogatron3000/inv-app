<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Ticket;
use App\Providers\TicketApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TicketApprovedListener
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
     * @param  TicketApproved  $event
     * @return void
     */
    public function handle(TicketApproved $event)
    {
        Activity::query()->create([
            'description' => 'approved',
            'user_id' => auth()->id(),
            'subject_id' => $event->ticket->id,
            'subject_type' => Ticket::class,
        ]);
    }
}
