<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
            'name'=> 'super_admin',
        ]);
        $admin = Role::create([
            'name'=> 'admin',
        ]);
        $user = Role::create([
            'name'=> 'user',
        ]);
        
    }
}
