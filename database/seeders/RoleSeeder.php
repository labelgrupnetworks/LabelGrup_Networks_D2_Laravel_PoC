<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $sellerRole = Role::create(['name' => 'seller']);

        // Products
        Permission::create(['name' => 'api.products.index'])->syncRoles([$adminRole, $moderatorRole, $sellerRole]);
        Permission::create(['name' => 'api.products.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'api.products.show'])->syncRoles([$adminRole, $moderatorRole, $sellerRole]);
        Permission::create(['name' => 'api.products.update'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.products.destroy'])->syncRoles([$adminRole]);

        // Categories
        Permission::create(['name' => 'api.categories.index'])  ->syncRoles([$adminRole, $moderatorRole, $sellerRole]);
        Permission::create(['name' => 'api.categories.store'])  ->syncRoles([$adminRole]);
        Permission::create(['name' => 'api.categories.show'])   ->syncRoles([$adminRole, $moderatorRole, $sellerRole]);
        Permission::create(['name' => 'api.categories.update']) ->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.categories.destroy'])->syncRoles([$adminRole]);

        // Product-categories
        Permission::create(['name' => 'api.product-categories.index'])->syncRoles([$adminRole, $moderatorRole, $sellerRole]);
        Permission::create(['name' => 'api.product-categories.store'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.product-categories.update'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.product-categories.destroy'])->syncRoles([$adminRole, $moderatorRole]);

        Permission::create(['name' => 'api.category-main'])->syncRoles([$adminRole, $moderatorRole]);

        // Users
        Permission::create(['name' => 'api.users.index'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.users.store'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'api.users.show'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.users.update'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.users.destroy'])->syncRoles([$adminRole]);

        // Images
        Permission::create(['name' => 'api.images.index'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.images.show'])->syncRoles([$adminRole, $moderatorRole]);
        Permission::create(['name' => 'api.images.destroy'])->syncRoles([$adminRole]);
    }
}
