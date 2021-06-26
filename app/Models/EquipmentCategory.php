<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function equipment(){
        return $this->hasMany(Equipment::class);
    }

    public function equipmentInStock(){
        return $this->hasMany(Equipment::class)->inStock();
    }

    public function serialNumbers()
    {
        return $this->hasManyThrough(SerialNumber::class, Equipment::class);
    }

    public function faq()
    {
        return$this->hasMany(FAQ::class);
    }
}
