<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'read permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);
        
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'read role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        $role = Role::create(['name' => 'super-admin'])
            ->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo([
                    'create permission', 
                    'read permission', 
                    'update permission',
                    'create role', 
                    'read role', 
                    'update role',
                    'create user', 
                    'read user', 
                    'update user'
                ]);

        $role = Role::create(['name' => 'user']);
    }
}
