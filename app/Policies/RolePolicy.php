<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy extends Policy
{
    use HandlesAuthorization;

    public function manage()
    {
        return false;
    }
}
