<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();

        // create permissions for products
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'get product']);
        Permission::create(['name' => 'assign categories']);

        // create permissions for categories
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'get category']);

        // create permissions for images
        Permission::create(['name' => 'edit image']);
        Permission::create(['name' => 'delete image']);
        Permission::create(['name' => 'create image']);
        Permission::create(['name' => 'get image']);

        $admin=User::create([
            'name'=>'Admin',
            'email'=>'administrador@labelgrup.com',
            'password'=> '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ]);

        $rol_admin=Role::where('name', 'Administrador')->first();
        $admin->assignRole($rol_admin);
        $admin->givePermissionTo(['edit product', 'delete product', 'create product', 'get product', 'assign categories']);
        $admin->givePermissionTo(['edit category', 'delete category', 'create category', 'get category']);
        $admin->givePermissionTo(['edit image', 'delete image', 'create image', 'get image']);
        $admin->givePermissionTo(['edit user', 'delete user', 'create user', 'get user']);

        $moderator=User::create([
            'name'=>'Moderator',
            'email'=>'moderador@labelgrup.com',
            'password'=> '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ]);

        $rol_moderator=Role::where('name', 'Moderador')->first();
        $moderator->assignRole($rol_moderator);

        $moderator->givePermissionTo(['edit product', 'create product', 'get product', 'assign categories']);
        $moderator->givePermissionTo(['edit category', 'create category', 'get category']);
        $moderator->givePermissionTo(['edit image', 'create image', 'get image']);

        $commercial=User::create([
            'name'=>'Comercial',
            'email'=>'comercial@labelgrup.com',
            'password'=> '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
        ]);

        $rol_commercial=Role::where('name', 'Comercial')->first();
        $commercial->assignRole($rol_commercial);
        $commercial->givePermissionTo([ 'create product', 'get product']);
        $commercial->givePermissionTo([ 'create category', 'get category']);
        $commercial->givePermissionTo([ 'create image', 'get image']);
    }
}
