<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return (! $user->isRegularUser());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return (! $user->isRegularUser()) || $user->id === $model->id;
    }

    /**
     * @param  \App\Models\User  $user
     *
     * @return bool
     */
    public function manage(User $user)
    {
        return false;
    }
}
