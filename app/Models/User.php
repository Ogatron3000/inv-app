<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    public const PAGINATE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name',
            'email',
            'password',
            'position_id',
            'role_id',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    public function getDepartmentIdAttribute()
    {
        return $this->position->department_id ?? '/';
    }

    public function getDepartmentNameAttribute()
    {
        return $this->position->name ?? '/';
    }

    public function getPositionNameAttribute()
    {
        return $this->position->name ?? '/';
    }

    public function getRoleNameAttribute()
    {
        return $this->role->name ?? '/';
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function items()
    {
        return $this->hasMany(UserEquipment::class);
    }

    // public function scopeItemsInUse()
    // {
    //     return $this->items()->whereNull('return_date');
    // }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function visibleTickets()
    // {
    //     switch (auth()->user()->role_id) {
    //         case Role::SUPER_ADMIN:
    //             return Ticket::query();
    //         case Role::ADMINISTRATION:
    //             return Ticket::query()->where('ticketable_type', OfficeSuppliesTicket::class);
    //         case Role::SUPPORT:
    //             return Ticket::query()->where('ticketable_type', EquipmentTicket::class);
    //         default:
    //             return Ticket::query()->where('user_id', auth()->id());
    //     }
    // }

    // public function visiblePurchaseOrders()
    // {
    //     $user = auth()->user();
    //
    //     if ($user->isSuperAdmin() || $user->isHR()) {
    //         return PurchaseOrder::query();
    //     }
    //
    //     return PurchaseOrder::query()->where('officer_id', auth()->id());
    // }

    public function isSuperAdmin()
    {
        return $this->role_id === Role::SUPER_ADMIN;
    }

    public function isSupport()
    {
        return $this->role_id === Role::SUPPORT;
    }

    public function isAdministration()
    {
        return $this->role_id === Role::ADMINISTRATION;
    }

    public function isHR()
    {
        return $this->role_id === Role::HR;
    }

    public function isRegularUser()
    {
        return $this->role_id === Role::USER;
    }
}
