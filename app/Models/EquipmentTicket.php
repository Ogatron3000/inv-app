<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentTicket extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['equipmentCategory'];

    public function ticket()
    {
        return $this->morphOne(Ticket::class, 'ticketable');
    }

    public function equipmentCategory()
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    public function requestedEquipmentInStock()
    {
        return $this->equipmentCategory->equipmentInStock()->count() > 0;
    }
}
