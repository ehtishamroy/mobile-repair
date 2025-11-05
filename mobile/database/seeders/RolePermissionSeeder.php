<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            ['name' => 'View Dashboard', 'slug' => 'view-dashboard', 'description' => 'Can view the admin dashboard'],
            ['name' => 'Manage Users', 'slug' => 'manage-users', 'description' => 'Can create, edit, and delete users'],
            ['name' => 'Manage Roles', 'slug' => 'manage-roles', 'description' => 'Can create, edit, and delete roles'],
            ['name' => 'Manage Permissions', 'slug' => 'manage-permissions', 'description' => 'Can manage permissions'],
            ['name' => 'Manage Products', 'slug' => 'manage-products', 'description' => 'Can manage products'],
            ['name' => 'Manage Orders', 'slug' => 'manage-orders', 'description' => 'Can manage orders'],
            ['name' => 'Manage Repairs', 'slug' => 'manage-repairs', 'description' => 'Can manage repair bookings'],
            ['name' => 'View Reports', 'slug' => 'view-reports', 'description' => 'Can view reports'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Create Roles
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Full system access with all permissions',
                'permissions' => ['view-dashboard', 'manage-users', 'manage-roles', 'manage-permissions', 'manage-products', 'manage-orders', 'manage-repairs', 'view-reports']
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrative access with most permissions',
                'permissions' => ['view-dashboard', 'manage-users', 'manage-products', 'manage-orders', 'manage-repairs', 'view-reports']
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Can manage products, orders, and repairs',
                'permissions' => ['view-dashboard', 'manage-products', 'manage-orders', 'manage-repairs', 'view-reports']
            ],
            [
                'name' => 'Staff',
                'slug' => 'staff',
                'description' => 'Limited access for staff members',
                'permissions' => ['view-dashboard', 'manage-orders', 'manage-repairs']
            ],
        ];

        foreach ($roles as $roleData) {
            $permissions = $roleData['permissions'];
            unset($roleData['permissions']);

            $role = Role::create($roleData);

            // Assign permissions to role
            $permissionIds = Permission::whereIn('slug', $permissions)->pluck('id');
            $role->permissions()->attach($permissionIds);
        }
    }
}
