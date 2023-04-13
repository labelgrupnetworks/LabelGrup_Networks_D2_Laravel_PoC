<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

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
                    ->state(function (array $attributes, User $user) {
                        return ['user_id' => $user->id];
                    })
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

        $user = User::find(1);

        $user->assignRole(User::ADMINISTRATOR);

        $users = User::whereIn('id', [2, 3])->get();

        foreach ($users as $user) {
            $user->assignRole(User::MODERATOR);
        }

        $users = User::whereIn('id', [4, 5])->get();

        foreach ($users as $user) {
            $user->assignRole(User::COMMERCIAL);
        }

        $this->defineCustomUsers();
    }

    private function defineCustomUsers(): void
    {
        $administrator = User::factory()
            ->create([
                'email' => 'administrator@administrator.test'
            ]);

        $administrator->assignRole(User::ADMINISTRATOR);

        $moderator = User::factory()
            ->create([
                'email' => 'moderator@moderator.test'
            ]);

        $moderator->assignRole(User::MODERATOR);

        $commercial = User::factory()
            ->create([
                'email' => 'commercial@commercial.test'
            ]);

        $moderator->assignRole(User::COMMERCIAL);
    }
}
