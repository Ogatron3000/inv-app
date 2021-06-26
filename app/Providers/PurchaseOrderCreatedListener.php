<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\PurchaseOrder;
use App\Providers\PurchaseOrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurchaseOrderCreatedListener
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
     * @param  PurchaseOrderCreated  $event
     * @return void
     */
    public function handle(PurchaseOrderCreated $event)
    {
        Activity::query()->create([
            'description' => 'created',
            'user_id' => auth()->id(),
            'subject_id' => $event->purchaseOrder->id,
            'subject_type' => PurchaseOrder::class,
        ]);
    }
}
