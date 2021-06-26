<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function equipmentCategory()
    {
        return $this->belongsTo(EquipmentCategory::class);
    }
}
