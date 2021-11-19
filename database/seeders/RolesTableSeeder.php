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

        $superAdmin->permissions()->attach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]);
        
    }
}
