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
    public function run()
    {
        Role::create([
                'id' => 'ROLE_ADMIN',
                'name' => 'Administrator'
        ]);
        
        Role::create([
                'id' => 'ROLE_USER',
                'name' => 'Usuario'
            ]);
    }
}
