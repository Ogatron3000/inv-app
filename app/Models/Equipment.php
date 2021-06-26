<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'serialNumbers', 'availableSerialNumbers'];

    public const PAGINATE = 10;

    public function category()
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
    }

    public function userEquipment()
    {
        return $this->hasMany(UserEquipment::class);
    }

    public function serialNumbers()
    {
        return $this->hasMany(SerialNumber::class);
    }

    public function availableSerialNumbers()
    {
        return $this->hasMany(SerialNumber::class)->available();
    }

    public function getAvailableQuantityAttribute()
    {
        return $this->availableSerialNumbers->count();
    }

    public function getShortDescriptionAttribute()
    {
        if (strlen($this->description) < 25) {
            return $this->description;
        } else {
            return substr($this->description, 0, 25) . '...';
        }
    }

    public function getFullNameAttribute()
    {
        return $this->category->name . " - " . $this->name;
    }

    public function scopeInStock($query)
    {
        return $query->whereHas('serialNumbers', function ($serialNumQuery) {
            $serialNumQuery->available();
        });
    }

}
