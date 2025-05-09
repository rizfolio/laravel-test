<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Sale;

class SaleTest extends TestCase
{
    public function it_can_create_a_sale()
    {
         $product = Product::factory()->create([
            'unit_cost' => 10,
            'commission' => 0.25,
        ]);

        // Act: Create a sale manually (not via Livewire)
        $quantity = 2;
        $shipping_cost = 10;
        $unit_cost = 10;
        $commission = 0.25;
        $profit_margin = 1 - $commission;
        $expected_selling_price = round((($unit_cost / $profit_margin) + $shipping_cost) * $quantity, 2);

        $sale = Sale::create([
            'product_id'     => $product->id,
            'quantity'       => $quantity,
            'unit_cost'      => $unit_cost,
            'commission'     => $commission,
            'shipping_cost'  => $shipping_cost,
            'selling_price'  => $expected_selling_price,
        ]);

        
        $this->assertDatabaseHas('sales', [
            'id'             => $sale->id,
            'product_id'     => $product->id,
            'quantity'       => $quantity,
            'unit_cost'      => $unit_cost,
            'commission'     => $commission,
            'shipping_cost'  => $shipping_cost,
            'selling_price'  => $expected_selling_price,
        ]);
    }
}
