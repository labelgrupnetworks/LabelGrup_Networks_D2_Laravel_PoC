<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();

        User::factory()
            ->count(5)
            ->has(
                Product::factory()
                    ->has(
                        Image::factory()
                            ->count(3)
                    )
                    ->count(20)
            )
            ->create();

        $products = Product::all();

        foreach ($products as $product) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $isMain = true;
            foreach ($categories as $category) {
                $product->categories()->attach($category, ['is_main' => $isMain]);
                $isMain = false;
            }
        }
    }
}
