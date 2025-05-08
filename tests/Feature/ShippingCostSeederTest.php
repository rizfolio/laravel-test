<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ShippingCost;
use Database\Seeders\ShippingCostSeeder;

class ShippingCostSeederTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->seed(ShippingCostSeeder::class);

        $this->assertEquals(10, ShippingCost::count());
        $this->assertDatabaseHas('shipping_costs', [
            'shipping_cost' => function ($value) {
                return $value >= 1 && $value <= 50;
            },
        ]);
    }
}
