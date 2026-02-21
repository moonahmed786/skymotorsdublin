<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
            'car.view',
            'car.create',
            'car.edit',
            'car.delete',
            'brand.view',
            'brand.create',
            'brand.edit',
            'brand.delete',
            'cartype.view',
            'cartype.create',
            'cartype.edit',
            'cartype.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles and assign created permissions

        // Super Admin
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo(Permission::all());
        // Note: You might want to restrict some permissions for 'Admin' vs 'Super Admin' later.

        // Sales Rep
        $salesRep = Role::create(['name' => 'Sales Rep']);
        $salesRep->givePermissionTo([
            'car.view',
            'car.create',
            'car.edit',
            'brand.view',
            'cartype.view',
        ]);

        // Assign Super Admin role to the default admin user if exists
        $user = \App\Models\User::where('email', 'admin@skymotors.com')->first();
        if ($user) {
            $user->assignRole('Super Admin');
        }
    }
}
