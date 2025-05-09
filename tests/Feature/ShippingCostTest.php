<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ShippingCost;
 
class ShippingCostTest extends TestCase
{
  
    public function it_can_create_shipping_cost()
    {
        // Act: Create a shipping cost record
        $shipping = ShippingCost::create([
            'shipping_cost' => 10.00
        ]);

        // Assert: It exists in the database
        $this->assertDatabaseHas('shipping_costs', [
            'id' => $shipping->id,
            'shipping_cost' => 10.00
        ]);
    }
}
