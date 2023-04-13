<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TODO: Extract them to dedicated class for each role and assign permissions.

        $permissions = User::rolePermissions();

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $administratorPermissions = User::administratorPermissions();

        $role = Role::create([
            'name' => User::ADMINISTRATOR,
        ]);

        $role->givePermissionTo($administratorPermissions);

        $moderatorPermissions = User::moderatorPermissions();

        $role = Role::create([
            'name' => User::MODERATOR,
        ]);

        foreach ($moderatorPermissions as $permission) {
            $role->givePermissionTo($permission);
        }

        $commercialsPermissions = User::commercialPermissions();

        $role = Role::create([
            'name' => User::COMMERCIAL,
        ]);

        foreach ($commercialsPermissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::truncate();
    }
};
