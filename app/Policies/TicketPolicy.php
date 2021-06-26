<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy extends Policy
{
    use HandlesAuthorization;

    // /**
    //  * Determine whether the user can view any models.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return mixed
    //  */
    // public function viewAny(User $user)
    // {
    //     return (! $user->isRegularUser());
    // }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        return (($ticket->isEquipmentTicket() || $ticket->isRepairTicket()) && $user->isSupport())
            || ($ticket->isOfficeSuppliesTicket() && $user->isAdministration())
            || $ticket->user_id === $user->id;
    }

    /**
     * @param  \App\Models\User  $user
     *
     * @return bool
     */
    public function manage(User $user, Ticket $ticket)
    {
        // or is not open -- it's the same
        return ( ! $ticket->hasOfficer())
            && ((($ticket->isEquipmentTicket() || $ticket->isRepairTicket()) && $user->isSupport())
                || ($ticket->isOfficeSuppliesTicket() && $user->isAdministration()));
    }

    public function control(User $user, Ticket $ticket)
    {
        return $ticket->isOpen() && $user->id === $ticket->officer_id;
    }

    public function update(User $user, Ticket $ticket)
    {
        return ($user->id === $ticket->officer_id)
            || ($ticket->user_id === $user->id && $ticket->isPending());
    }

    public function comment(User $user, Ticket $ticket)
    {
        return $this->view($user, $ticket) && $ticket->isOpen();
    }
}
