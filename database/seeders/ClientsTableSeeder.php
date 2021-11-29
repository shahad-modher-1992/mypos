<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'name'     => "hind",
                "phone"    => "07727858620",
                "address"  => "baghdad"
            ],
            [
                'name'     => "ali",
                "phone"    => "07727858650",
                "address"  => "kuit"
            ],
            ]);
    }
}
