<?php

namespace Database\Factories;

use Domain\Products\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->unique()->paragraph,
            'price' => $this->faker->randomFloat(2, 100.00, 999999.99),
            'stock' => $this->faker->numberBetween(1, 99)
        ];
    }
}
