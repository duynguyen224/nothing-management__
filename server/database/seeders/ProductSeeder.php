<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $random = rand(1, 5);
            Product::create([
                'name' => 'Product ' . $i,
                'price' => ($i + 5) * $random * 1000,
                'category_id' => $random
            ]);
        }
    }
}
