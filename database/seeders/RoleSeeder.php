<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $roles = [
            1 => 'Super Administrator',
            2 => 'Administrator',
            3 => 'Support',
            4 => 'HR',
            5 => 'User',
        ];
        foreach ($roles as $key => $role) {
            Role::query()->create(['id' => $key, 'name' => $role]);
        }
    }

}
