<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairTicket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ticket()
    {
        return $this->morphOne(Ticket::class, 'ticketable');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function estimate($finishDate)
    {
        $this->update([
            'estimated_finish_date' => $finishDate,
        ]);
    }
}
