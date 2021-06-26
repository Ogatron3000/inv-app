<?php

namespace App\Providers;

use App\Models\Comment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TicketCreated::class => [
            TicketCreatedListener::class
        ],
        TicketUpdated::class => [
            TicketUpdatedListener::class
        ],
        TicketManaged::class => [
            TicketManagedListener::class
        ],
        TicketReleased::class => [
            TicketReleasedListener::class
        ],
        TicketApproved::class => [
            TicketApprovedListener::class
        ],
        TicketRejected::class => [
            TicketRejectedListener::class
        ],
        TicketClosed::class => [
            TicketClosedListener::class
        ],
        CommentAdded::class => [
            CommentAddedListener::class
        ],
        PurchaseOrderCreated::class => [
            PurchaseOrderCreatedListener::class
        ],
        PurchaseOrderUpdated::class => [
            PurchaseOrderUpdatedListener::class
        ],
        PurchaseOrderApproved::class => [
            PurchaseOrderApprovedListener::class
        ],
        PurchaseOrderRejected::class => [
            PurchaseOrderRejectedListener::class
        ],
        PurchaseOrderClosed::class => [
            PurchaseOrderClosedListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
