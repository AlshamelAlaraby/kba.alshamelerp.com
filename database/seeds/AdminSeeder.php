<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Modules\Admin\Models\Admin::query()->firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456')
        ]);

        $role = Role::query()->firstOrCreate(['name' => 'Admin', 'guard_name' => 'admin']);
        if (empty(Permission::query()->first()))
            Permission::insert([
                ['name' => 'Create Roles', 'guard_name' => 'admin'],
                ['name' => 'Edit Roles', 'guard_name' => 'admin'],
                ['name' => 'Delete Roles', 'guard_name' => 'admin'],
                ['name' => 'List Roles', 'guard_name' => 'admin'],

                ['name' => 'Create Admins', 'guard_name' => 'admin'],
                ['name' => 'Edit Admins', 'guard_name' => 'admin'],
                ['name' => 'Delete Admins', 'guard_name' => 'admin'],
                ['name' => 'List Admins', 'guard_name' => 'admin'],

            ]);

        $role->syncPermissions(['Create Roles', 'Edit Roles', 'Delete Roles', 'List Roles',
            'Create Admins', 'Edit Admins', 'Delete Admins', 'List Admins'
        ]);

        $admin->syncRoles('Admin');
    }
}
