<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\EquipmentTicket;
use App\Models\OfficeSuppliesTicket;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketAvailableNotification;
use App\Providers\TicketReleased;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class TicketReleasedListener
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
     * @param  TicketReleased  $event
     * @return void
     */
    public function handle(TicketReleased $event)
    {
        Activity::query()->create([
            'description' => 'released',
            'user_id' => auth()->id(),
            'subject_id' => $event->ticket->id,
            'subject_type' => Ticket::class,
        ]);
    }
}
