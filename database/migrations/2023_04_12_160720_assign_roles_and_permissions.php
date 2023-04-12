<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TODO: Extract them to dedicated class for each role and assign permissions.

        $permissions = [
            'read:products', 'create:products', 'update:products', 'delete:products',
            'read:images', 'create:images', 'update:images', 'delete:images',
            'read:categories', 'create:categories', 'update:categories', 'delete:categories',
        ];

        foreach ($permissions as $permission) {
            $permission = Permission::create(['name' => $permission]);
        }

        $administratorPermissions = [
            'read:products', 'create:products', 'update:products', 'delete:products',
            'read:images', 'create:images', 'update:images', 'delete:images',
            'read:categories', 'create:categories', 'update:categories', 'delete:categories',
        ];

        $role = Role::create([
            'name' => 'administrator',
        ]);

        $role->givePermissionTo(Permission::all());

        $moderatorPermissions = [
            'read:products', 'create:products', 'update:products',
            'read:images', 'create:images', 'update:images',
            'read:categories', 'create:categories', 'update:categories',
        ];

        $role = Role::create([
            'name' => 'moderator',
        ]);

        foreach ($moderatorPermissions as $permission) {
            $role->givePermissionTo($permission);
        }

        $commercialsPermissions = [
            'read:products',
            'read:images',
            'read:categories',
        ];

        $role = Role::create([
            'name' => 'commercial',
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
