<?php

namespace App\Models;

use App\Providers\TicketApproved;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $with = ['ticketStatus', 'officer', 'ticketable'];

    protected $dates = ['approval_date'];

    public const PAGINATE = 10;

    // Ticket Statuses
    public const PENDING = 1;
    public const IN_PROGRESS = 2;
    public const PROCESSED = 3;

    // Ticket Types
    public const EQUIPMENT_TICKET = 'Equipment Ticket';
    public const OFFICE_SUPPLIES_TICKET = 'Office Supplies Ticket';
    public const REPAIR_TICKET = 'Repair Ticket';
    public const TICKET_TYPES = [self::EQUIPMENT_TICKET, self::OFFICE_SUPPLIES_TICKET, self::REPAIR_TICKET];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function purchaseOrder()
    {
        return $this->hasOne(PurchaseOrder::class);
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function ticketable()
    {
        return $this->morphTo();
    }

    public function scopeOpen($query)
    {
        return $query->whereIn('ticket_status_id',
            [self::PENDING, self::IN_PROGRESS]);
    }

    public function getTypeAttribute()
    {
        return getClassName($this->ticketable_type);
    }

    public function getStatusAttribute()
    {
        return $this->ticketStatus->name;
    }

    public function getOfficerNameAttribute()
    {
        return $this->officer->name ?? '/';
    }

    public function getApprovalDateFormattedAttribute()
    {
        return $this->approval_date ? $this->approval_date->format('d.m.Y') : '/';
    }

    public function manage($attributes = null)
    {
        $this->update([
            'officer_id'       => auth()->id(),
            'ticket_status_id' => self::IN_PROGRESS,
        ]);

        // we can have each model have their own manage method,
        // and call $this->ticketable->manage($data)
        // but we only have 1 special case for now
        if ($this->isRepairTicket()) {
            $this->ticketable->estimate($attributes['estimated_finish_date']);
        }
    }

    public function release()
    {
        $this->update([
            'officer_id'       => null,
            'ticket_status_id' => self::PENDING,
        ]);
    }

    public function approve()
    {
        $this->update([
            'ticket_status_id' => self::PROCESSED,
            'approval_date' => Carbon::now(),
        ]);
    }

    public function reject($content)
    {
        $this->comments()->create([
            'content' => $content,
            'user_id' => auth()->id(),
            'rejection_comment' => true,
        ]);

        $this->update([
            'ticket_status_id' => self::PROCESSED,
        ]);
    }

    public function isEquipmentTicket()
    {
        return $this->ticketable_type === EquipmentTicket::class;
    }

    public function isOfficeSuppliesTicket()
    {
        return $this->ticketable_type === OfficeSuppliesTicket::class;
    }

    public function isRepairTicket()
    {
        return $this->ticketable_type === RepairTicket::class;
    }

    public function hasOfficer()
    {
        return $this->officer_id !== null;
    }

    public function isPending()
    {
        return $this->ticket_status_id === self::PENDING;
    }

    public function isOpen()
    {
        return $this->ticket_status_id !== self::PROCESSED;
    }
}
