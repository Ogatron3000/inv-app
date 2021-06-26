<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\PurchaseOrder;
use App\Providers\PurchaseOrderUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurchaseOrderUpdatedListener
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
     * @param  PurchaseOrderUpdated  $event
     * @return void
     */
    public function handle(PurchaseOrderUpdated $event)
    {
        Activity::query()->create([
            'description' => 'updated',
            'user_id' => auth()->id(),
            'subject_id' => $event->purchaseOrder->id,
            'subject_type' => PurchaseOrder::class,
        ]);
    }
}
