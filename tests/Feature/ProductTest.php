<?php 

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_product()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/products', [
            'name' => 'Test Coffee',
            'unit_cost' => 15.50,
            'commission' => 0.20,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Test Coffee',
            'unit_cost' => 15.50,
            'commission' => 0.20,
        ]);
    }

    public function test_product_validation_errors()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/products', [
            'name' => '', // missing
            'unit_cost' => 'not-a-number',
            'commission' => 1.5, // > 1.0 is invalid
        ]);

        $response->assertSessionHasErrors(['name', 'unit_cost', 'commission']);
    }

    public function test_authenticated_user_can_view_products()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Product::factory()->create(['name' => 'Gold Coffee']);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Gold Coffee');
    }

    public function test_authenticated_user_can_update_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['name' => 'Old Name']);

        $response = $this->actingAs($user)->put("/products/{$product->id}", [
            'name' => 'Updated Name',
            'unit_cost' => 12.00,
            'commission' => 0.15,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['name' => 'Updated Name']);
    }

    public function test_authenticated_user_can_delete_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->delete("/products/{$product->id}");

        $response->assertRedirect('/products');
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
