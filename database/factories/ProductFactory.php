<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'stock' => fake()->numberBetween(2, 10),
            'price' => fake()->numberBetween(10 * Product::PER_CENT, 200 * Product::PER_CENT),
            //'user_id' => fake()->numberBetween(1, 6),
        ];
    }
}
