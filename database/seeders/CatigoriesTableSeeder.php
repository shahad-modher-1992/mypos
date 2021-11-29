<?php

namespace Database\Seeders;

use App\Models\catigory;
use App\Models\CatigoryTranslation;
use Illuminate\Database\Seeder;

class CatigoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = ['cat 1', 'cat 2', 'cat 3'];
        foreach($cats as $cat) {
            catigory::create([
                'ar' => ['name' => $cat],
                'en' => ['name' => $cat]
            ]);
        }
    }
}
