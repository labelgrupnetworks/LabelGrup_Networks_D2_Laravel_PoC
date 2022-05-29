<?php

namespace Database\Seeders;

use Domain\Categories\Models\Category;
use Domain\Products\Models\Product;
use Domain\Users\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        User::factory(10)->create();

        $categories = Category::factory(10)->create();

        Product::factory(50)
            ->create()
            ->each(function (Product $product) use ($categories) {
                $product
                    ->categories()
                    ->attach($categories->random(3)->pluck('id')->toArray());
            });

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
