<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManageTicketRequest;
use App\Http\Requests\RejectTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Comment;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\EquipmentTicket;
use App\Models\OfficeSuppliesTicket;
use App\Models\PurchaseOrder;
use App\Models\Ticket;
use App\Providers\TicketApproved;
use App\Providers\TicketClosed;
use App\Providers\TicketCreated;
use App\Providers\TicketManaged;
use App\Providers\TicketRejected;
use App\Providers\TicketReleased;
use App\Providers\TicketUpdated;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // search
        if ($request->has('q')) {
            $search = $request->q;
            $tickets = Ticket::whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            })
                ->orderBy('ticket_status_id')
                ->paginate(Ticket::PAGINATE);
        } else {
            $tickets = Ticket::orderBy('ticket_status_id')->paginate(Ticket::PAGINATE);
        }

        $ticketTypes = Ticket::TICKET_TYPES;

        return view('tickets.index', compact('ticketTypes', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ( ! $request->ticket_type) {
            return redirect()->back();
        }

        $ticketType = $request->ticket_type;
        $categories = EquipmentCategory::all();

        return view('tickets.create', compact('ticketType', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $attributes = $request->validated();

        $ticketTypeClass = getModelNamespace($attributes['ticket_type']['name']);
        $ticketTypeInstance = call_user_func($ticketTypeClass . '::create', $attributes['ticket_data']);

        $ticket = $ticketTypeInstance->ticket()->create(['user_id' => auth()->id()]);

        if ($content = $attributes['comment']['content']) {
            $ticket->comments()->create([
                'content' => $content,
                'user_id' => auth()->id(),
            ]);
        }

        event(new TicketCreated($ticket));

        return redirect()->route('tickets.show', $ticket->id)->with('success_message', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $categories = EquipmentCategory::all();

        return view('tickets.edit', compact('ticket', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket                      $ticket
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $attributes = $request->validated();

        $ticket->ticketable()->update($attributes);

        event(new TicketUpdated($ticket));

        return redirect()->route('tickets.show', $ticket->id)->with('success_message', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success_message', 'Ticket deleted successfully.');
    }

    public function manage(ManageTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('manage', $ticket);

        $ticket->manage($request->validated());

        event(new TicketManaged($ticket));

        return redirect()->back()->with('success_message', 'You started managing this ticket.');
    }

    public function release(Request $request, Ticket $ticket)
    {
        $this->authorize('control', $ticket);

        $ticket->release();

        event(new TicketReleased($ticket));

        return redirect()->back()->with('success_message', 'Ticket released successfully.');
    }

    public function approve(Ticket $ticket)
    {
        $this->authorize('control', $ticket);

        $ticket->approve();

        event(new TicketApproved($ticket));
        event(new TicketClosed($ticket));

        return redirect()->back()->with('success_message', 'Ticket approved successfully.');
    }

    public function reject(RejectTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('control', $ticket);

        $ticket->reject($request->validated()['rejection_comment']);

        event(new TicketRejected($ticket));
        event(new TicketClosed($ticket));

        return redirect()->back()->with('success_message', 'Ticket denied and closed successfully.');
    }

    public function equipment(Request $request, Ticket $ticket)
    {
        $equipmentCategoryId = $ticket->ticketable->equipment_category_id;

        $equipment = Equipment::query()->with('serialNumbers')->inStock()->where('equipment_category_id', $equipmentCategoryId)->get();

        return compact('equipment');
    }
}
