<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $statuses = [1 => 'Pending', 2 => 'In progress', 3 => 'Processed'];
        foreach ($statuses as $key => $status) {
            TicketStatus::query()->create([
                'id' => $key,
                'name' => $status
            ]);
        }
    }
}
