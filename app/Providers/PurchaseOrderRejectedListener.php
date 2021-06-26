<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\PurchaseOrder;
use App\Providers\PurchaseOrderRejected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurchaseOrderRejectedListener
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
     * @param  PurchaseOrderRejected  $event
     * @return void
     */
    public function handle(PurchaseOrderRejected $event)
    {
        Activity::query()->create([
            'description' => 'rejected',
            'user_id' => auth()->id(),
            'subject_id' => $event->purchaseOrder->id,
            'subject_type' => PurchaseOrder::class,
        ]);
    }
}
