<?php

namespace Database\Seeders;

use App\Models\SerialNumber;
use Illuminate\Database\Seeder;

class SerialNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        for ($i = 1; $i < 16; $i++) {
            SerialNumber::query()->create([
                'serial_number' => $i,
                'equipment_id' => $i % 5 + 1,
            ]);
        }
    }
}
