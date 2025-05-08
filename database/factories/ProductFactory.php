<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true) . ' Coffee',
            'unit_cost' => $this->faker->randomFloat(2, 5, 20),
            'commission' => $this->faker->randomFloat(2, 0.1, 0.5),
        ];
    }
}
