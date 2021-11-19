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
        $create_users = Permission::create([
          'name'=> "create_users"
        ]);
        $update_users = Permission::create([
          'name'=> "update_users"
        ]);
        $delete_users = Permission::create([
          'name'=> "delete_users"
        ]);
        $read_users = Permission::create([
          'name'=> "read_users"
        ]);

        /// products permission
        $create_products = Permission::create([
          'name'=> "create_products"
        ]);
        $update_products = Permission::create([
          'name'=> "update_products"
        ]);
        $delete_products = Permission::create([
          'name'=> "delete_products"
        ]);
        $read_products = Permission::create([
          'name'=> "read_products"
        ]);

        /// clients permissions
        $create_clients = Permission::create([
          'name'=> "create_clients"
        ]);
        $update_clients = Permission::create([
          'name'=> "update_clients"
        ]);
        $delete_clients = Permission::create([
          'name'=> "delete_clients"
        ]);
        $read_clients = Permission::create([
          'name'=> "read_clients"
        ]);

        /// categories permissions
        $create_categories = Permission::create([
          'name'=> "create_categories"
        ]);
        $update_categories = Permission::create([
          'name'=> "update_categories"
        ]);
        $delete_categories = Permission::create([
          'name'=> "delete_categories"
        ]);
        $read_categories = Permission::create([
          'name'=> "read_categories"
        ]);
        

        /// orders Permissions      
        $create_orders = Permission::create([
          'name'=> "create_orders"
        ]);
        $update_orders = Permission::create([
          'name'=> "update_orders"
        ]);
        $delete_orders = Permission::create([
          'name'=> "delete_orders"
        ]);
        $read_orders = Permission::create([
          'name'=> "read_orders"
        ]);
    }
}
