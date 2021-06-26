<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEquipment extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at', 'return_date', 'date'];

    protected $with = ['equipment', 'serialNumber', 'admin'];

    public const PAGINATE = 10;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function serialNumber()
    {
        return $this->belongsTo(SerialNumber::class);
    }

    public function getAdminNameAttribute()
    {
        return $this->admin->name ?? '/';
    }

    public function getSerialNoAttribute()
    {
        return $this->serialNumber->serial_number ?? '/';
    }

    public function getReturnedAttribute()
    {
        return $this->return_date != null;
    }

    public function getStartDateAttribute()
    {
        return $this->date->format('d.m.Y');
    }

    public function getReturnedDateFormatedAttribute()
    {
        if ($this->returned) {
            return $this->return_date->format('d.m.Y');
        } else {
            return '/';
        }
    }

}
