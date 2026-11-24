<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'nama' => fake()->words(2, true),
            'harga' => fake()->numberBetween(5000, 50000),
            'stok' => fake()->numberBetween(0, 100),
            'category_id' => Category::factory(),
        ];
    }
}
