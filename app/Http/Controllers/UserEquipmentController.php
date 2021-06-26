<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\UserEquipment;
use App\Models\User;
use App\Providers\TicketApproved;
use App\Providers\TicketClosed;
use Illuminate\Http\Request;

class UserEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('manage', UserEquipment::class);

        $request->merge(['user_id' => $user->id, 'admin_id' => auth()->id()]);
        $new_item = $user->items()->create($request->except('ticket_id'));
        // $new_item->equipment()->update(['available_quantity' => $new_item->equipment->available_quantity - 1]);

        if ($ticket = Ticket::find($request->ticket_id)) {
            $ticket->approve();
            event(new TicketApproved($ticket));
            event(new TicketClosed($ticket));
            $message = 'Equipment assigned and ticket closed successfully.';
        }

        return redirect(route('users.show', [$user->id]))->with('success_message',$message ?? 'Equipment assigned successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEquipment  $userEquipment
     *
     * @return \Illuminate\Http\Response
     */
    public function show(UserEquipment $userEquipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEquipment  $userEquipment
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEquipment $userEquipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \App\Models\UserEquipment  $userEquipment
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEquipment $userEquipment)
    {
        $this->authorize('manage', User::class);

        $userEquipment->update([ 'return_date' => date('Y-m-d H:i:s') ]);
        // $userEquipment->equipment()->update(['available_quantity' => $userEquipment->equipment->available_quantity + 1]);

        return redirect()->back()->with('success_message', 'Equipment returned successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEquipment  $userEquipment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEquipment $userEquipment)
    {
        //
    }
}
