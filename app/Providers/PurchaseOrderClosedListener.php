<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\PurchaseOrder;
use App\Notifications\PurchaseOrderProcessedNotification;
use App\Providers\PurchaseOrderClosed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurchaseOrderClosedListener
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
     * @param  PurchaseOrderClosed  $event
     * @return void
     */
    public function handle(PurchaseOrderClosed $event)
    {
        Activity::query()->create([
            'description' => 'closed',
            'user_id' => auth()->id(),
            'subject_id' => $event->purchaseOrder->id,
            'subject_type' => PurchaseOrder::class,
        ]);

        if ($event->purchaseOrder->officer_id !== auth()->id()) {
            $event->purchaseOrder->officer->notify(new PurchaseOrderProcessedNotification($event->purchaseOrder));
        }
    }
}
