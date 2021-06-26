<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\EquipmentTicket;
use App\Models\OfficeSuppliesTicket;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketAvailableNotification;
use App\Providers\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TicketCreatedListener
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
     * @param  TicketCreated  $event
     * @return void
     */
    public function handle(TicketCreated $event)
    {
        Activity::query()->create([
            'description' => 'created',
            'user_id' => $event->ticket->user_id,
            'subject_id' => $event->ticket->id,
            'subject_type' => Ticket::class,
        ]);
    }
}
