<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = Permission::create([
          'name'=> "create"
        ]);
        $update = Permission::create([
          'name'=> "update"
        ]);
        $delete = Permission::create([
          'name'=> "delete"
        ]);
        $read = Permission::create([
          'name'=> "read"
        ]);

        $create->roles()->attach(1);
        $update->roles()->attach(1);
        $delete->roles()->attach(1);
        $read->roles()->attach(1);
    }
}
