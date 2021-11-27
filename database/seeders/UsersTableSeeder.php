<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
          'name' => 'shahad',
          'email'=> "shahadmodher4@gmail.com",
          'password' => 12345678
        ]);

        $user->roles()->attach(1);
    }
}
