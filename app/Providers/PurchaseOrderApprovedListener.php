<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\PurchaseOrder;
use App\Providers\PurchaseOrderApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurchaseOrderApprovedListener
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
     * @param  PurchaseOrderApproved  $event
     * @return void
     */
    public function handle(PurchaseOrderApproved $event)
    {
        Activity::query()->create([
            'description' => 'approved',
            'user_id' => auth()->id(),
            'subject_id' => $event->purchaseOrder->id,
            'subject_type' => PurchaseOrder::class,
        ]);
    }
}
