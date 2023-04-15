<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public const ADMIN = 'admin';

    public const MOD = 'mod';

    public const COMERCIAL = 'comercial';
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => self::ADMIN]);
        Role::create(['name' => self::MOD]);
        Role::create(['name' => self::COMERCIAL]);

        Category::factory()->count(5)->create();
        User::factory()->count(5)->create();
        Product::factory()->count(10)->create();
        Image::factory()->count(20)->create();

        $users = User::get();
        foreach ($users as $user) {
            $user->assignRole(self::COMERCIAL);
        }

        $user_comercial = User::factory()->create(['email' => 'comercial@alex.com']);
        $user_comercial->assignRole(self::COMERCIAL);

        $user_mod = User::factory()->create(['email' => 'moderator@alex.com']);
        $user_mod->assignRole(self::MOD);

        $user_comercial = User::factory()->create(['email' => 'admin@alex.com']);
        $user_comercial->assignRole(self::ADMIN);
    }
}
