<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const SUPER_ADMIN = 1;
    public const ADMINISTRATION = 2; // administration admin
    public const SUPPORT = 3;
    public const HR = 4;
    public const USER = 5;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
