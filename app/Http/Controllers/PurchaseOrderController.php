<?php

namespace App\Http\Controllers;

use App\Http\Requests\RejectPurchaseOrderRequest;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\Comment;
use App\Models\PurchaseOrder;
use App\Models\Ticket;
use App\Providers\PurchaseOrderApproved;
use App\Providers\PurchaseOrderClosed;
use App\Providers\PurchaseOrderCreated;
use App\Providers\PurchaseOrderRejected;
use App\Providers\PurchaseOrderUpdated;
use App\Providers\TicketClosed;
use App\Providers\TicketRejected;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', PurchaseOrder::class);

        // search
        if ($request->has('q')) {
            $search = $request->q;
            $purchaseOrders = PurchaseOrder::whereHas('officer', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })
                ->orderBy('delivery_deadline')
                ->paginate(Ticket::PAGINATE);
        } else {
            $purchaseOrders = PurchaseOrder::orderBy('delivery_deadline')->paginate(PurchaseOrder::PAGINATE);
        }

        return view('purchase_orders.index', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {
        $this->authorize('control', $ticket);

        return view('purchase_orders.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseOrderRequest $request, Ticket $ticket)
    {
        $this->authorize('control', $ticket);

        $attributes = $request->validated();

        $purchaseOrder = PurchaseOrder::create(array_merge(
            $attributes['purchase_order'],
            [
                'ticket_id' => $ticket->id,
                'officer_id' => auth()->id(),
            ]
        ));

        if ($content = $attributes['comment']['content']) {
            $ticket->comments()->create([
                'content' => $content,
                'user_id' => auth()->id(),
            ]);
        }

        event(new PurchaseOrderCreated($purchaseOrder));

        return redirect()->route('purchase-orders.show', $purchaseOrder->id)->with('success_message', 'Purchase order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('view', $purchaseOrder);

        return view('purchase_orders.show', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('update', $purchaseOrder);

        return view('purchase_orders.edit', compact('purchaseOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $this->authorize('update', $purchaseOrder);

        $purchaseOrder->update($request->validated());

        event(new PurchaseOrderUpdated($purchaseOrder));

        return redirect()->route('purchase-orders.show', $purchaseOrder->id)->with('success_message', 'Purchase order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('update', $purchaseOrder);

        $purchaseOrder->delete();

        return redirect()->back()->with('success_message', 'Purchase order deleted successfully.');
    }

    public function approve(PurchaseOrder $purchaseOrder)
    {
        $this->authorize('manage', $purchaseOrder);

        $purchaseOrder->approve();

        event(new PurchaseOrderApproved($purchaseOrder));
        event(new PurchaseOrderClosed($purchaseOrder));

        return redirect()->back()->with('success_message', 'Purchase order approved successfully.');
    }

    public function reject(RejectPurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $this->authorize('manage', $purchaseOrder);

        $purchaseOrder->reject($request->validated()['rejection_comment']);

        event(new PurchaseOrderRejected($purchaseOrder));
        event(new PurchaseOrderClosed($purchaseOrder));
        event(new TicketRejected($purchaseOrder->ticket));
        event(new TicketClosed($purchaseOrder->ticket));

        return redirect()->back()->with('success_message', 'Purchase order denied and closed successfully.');
    }
}
