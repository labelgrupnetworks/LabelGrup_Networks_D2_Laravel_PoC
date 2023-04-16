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

        $admin=User::create([
            'name'=>'Admin',
            'email'=>'administrador@labelgrup.com',
            'password'=>Str::random(10)
        ]);

        $rol_admin=Role::where('name', 'Administrador')->first();
        $admin->assignRole($rol_admin);

        $moderator=User::create([
            'name'=>'Moderator',
            'email'=>'moderador@labelgrup.com',
            'password'=>Str::random(10)
        ]);

        $rol_moderator=Role::where('name', 'Moderador')->first();
        $moderator->assignRole($rol_moderator);

        $commercial=User::create([
            'name'=>'Comercial',
            'email'=>'comercial@labelgrup.com',
            'password'=>Str::random(10)
        ]);

        $rol_commercial=Role::where('name', 'Comercial')->first();
        $commercial->assignRole($rol_commercial);
    }
}
