<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipmentCategoryPolicy extends Policy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->isSupport();
    }
}
