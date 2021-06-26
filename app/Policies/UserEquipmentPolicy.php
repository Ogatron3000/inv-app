<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserEquipment;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserEquipmentPolicy extends Policy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->isSupport();
    }
}
