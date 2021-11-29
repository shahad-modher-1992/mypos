<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['product_1', 'product_2'];

        foreach($products as $product) {

            Product::create([
                'ar' => ['name' => $product,'desc' => "please buy from me"],
                'en' => ['name' => $product,'desc' => "please buy from me"],
                'purchase_price'=> 23.56,
                "sale_price"    => 76.33,
                "image"         => 'default.png',
                'catigory_id'   => 1,
                'stock'         => 100
            ]);
         
        }
    }
}
