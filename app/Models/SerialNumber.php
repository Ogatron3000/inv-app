<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getIsUsedAttribute(){
        return UserEquipment::query()
                ->where('equipment_id', '=', $this->equipment_id)
                ->where('serial_number_id', '=', $this->id)
                ->where('return_date', '=', null)
                ->count() > 0;
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function userEquipment()
    {
        return $this->hasMany(UserEquipment::class);
    }

    // get all serial numbers which are not part of document items or are returned
    public function scopeAvailable($query)
    {
        return $query->whereHas('userEquipment', function ($q) {
            $q->whereNull('return_date');
        }, '=', 0);
    }
}
