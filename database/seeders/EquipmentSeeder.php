<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        for ($i = 1; $i < 6; $i++) {
            Equipment::query()->create([
                'equipment_category_id' => $i,
                'name' => 'VRX' . $i,
                'description' => "I'm telling ya mate, this is an amazing piece of equipment."
            ]);
        }
    }
}
