<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $idsUsers = DB::table('users')->pluck('id_user');
        $idsCategories = DB::table('categories')->pluck('id_category');

        return [
            'id_user' => fake()->randomElement($idsUsers),
            'sku' => fake()->unique()->regexify('[A-Za-z0-9]{8}'),
            'name' => fake()->name(),
            'id_category' => fake()->randomElement($idsCategories),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(1, 99),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
