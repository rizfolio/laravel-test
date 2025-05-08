<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->create([
            'name' => 'Gold Coffee',
            'unit_cost' => 10.0,
            'commission' => 0.25,
        ]);

      //  Product::factory(5)->create(); // generates 5 random coffee products
    }
}
