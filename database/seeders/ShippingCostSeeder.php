<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingCost;

class ShippingCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingCost::create([
            'shipping_cost' => 10.00,
        ]);
    }
}
