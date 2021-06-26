<?php

namespace Database\Seeders;

use App\Models\SerialNumber;
use App\Models\UserEquipment;
use Illuminate\Database\Seeder;

class UserEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        for ($i = 1; $i < 6; $i++) {
            UserEquipment::query()->create([
                'user_id' => 1,
                'admin_id' => 1,
                'equipment_id' => $i,
                'serial_number_id' => SerialNumber::query()->where('equipment_id', $i)->first()->serial_number,
            ]);
        }
    }
}
