<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\EquipmentTicket;
use App\Models\OfficeSuppliesTicket;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketProcessedNotification;
use App\Providers\TicketClosed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TicketClosedListener
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
     * @param  TicketClosed  $event
     * @return void
     */
    public function handle(TicketClosed $event)
    {
        Activity::query()->create([
            'description' => 'closed',
            'user_id' => auth()->id(),
            'subject_id' => $event->ticket->id,
            'subject_type' => Ticket::class,
        ]);

        if ($event->ticket->user_id !== auth()->id()) {
            $event->ticket->user->notify(new TicketProcessedNotification($event->ticket));
        }
    }
}
