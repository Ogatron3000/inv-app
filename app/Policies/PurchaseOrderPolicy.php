<?php

namespace App\Policies;

use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchaseOrderPolicy extends Policy
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
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return mixed
     */
    public function view(User $user, PurchaseOrder $purchaseOrder)
    {
        return $user->id === $purchaseOrder->officer_id || $user->isHR();
    }

    public function update(User $user, PurchaseOrder $purchaseOrder)
    {
        return ($user->id === $purchaseOrder->officer_id && $purchaseOrder->isOpen()) || $user->isHR();
    }

    public function manage(User $user, PurchaseOrder $purchaseOrder)
    {
        return $purchaseOrder->isOpen() && $user->isHR();
    }

    public function comment(User $user, PurchaseOrder $purchaseOrder)
    {
        return $this->view($user, $purchaseOrder) && $purchaseOrder->isOpen();
    }
}
