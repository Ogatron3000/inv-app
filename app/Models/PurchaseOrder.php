<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['delivery_deadline'];

    protected $with = ['officer', 'hrOfficer'];

    public const PAGINATE = 10;

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'officer_id');
    }

    public function hrOfficer()
    {
        return $this->belongsTo(User::class, 'hr_officer_id');
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getOfficerNameAttribute()
    {
        return $this->officer->name ?? '/';
    }

    public function getHrOfficerNameAttribute()
    {
        return $this->hrOfficer->name ?? '/';
    }

    public function getDeliveryDeadlineFormattedAttribute()
    {
        return $this->delivery_deadline ? $this->delivery_deadline->format('d.m.Y') : '/';
    }

    public function getPriceAttribute($price)
    {
        return $price ?? '/';
    }

    public function getIsApprovedAttribute($isApproved)
    {
        if ($isApproved) {
            return 'Yes';
        } elseif ($isApproved === 0) {
            return 'No';
        }
        return '/';
    }

    public function approve()
    {
        $this->update(['is_approved' => true, 'hr_officer_id' => auth()->id()]);
    }

    public function reject($content)
    {
        $this->update(['is_approved' => false, 'hr_officer_id' => auth()->id()]);

        $this->comments()->create([
            'content' => $content,
            'user_id' => auth()->id(),
            'rejection_comment' => true,
        ]);

        $this->ticket->reject('Purchase Order Rejected: ' . $content);
    }

    public function isOpen()
    {
        return $this->is_approved === '/';
    }

    public function isApproved()
    {
        return $this->is_approved === 'Yes';
    }

    public function isRejected()
    {
        return $this->is_approved === 'No';
    }
}
