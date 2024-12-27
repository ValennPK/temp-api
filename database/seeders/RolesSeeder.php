<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $editor = Role::create(['name' => 'editor', 'guard_name' => 'web']);
        $normaluser = Role::create(['name' => 'user', 'guard_name' => 'web']);

        Permission::create(['name' => 'edit articles', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete articles', 'guard_name' => 'web']);
        Permission::create(['name' => 'publish articles', 'guard_name' => 'web']);
        Permission::create(['name' => 'unpublish articles', 'guard_name' => 'web']);

        $admin->syncPermissions(['edit articles', 'delete articles', 'publish articles', 'unpublish articles']);
        $editor->syncPermissions(['edit articles', 'publish articles', 'unpublish articles']);
        $normaluser->syncPermissions(['publish articles']);

        $user = User::find(1);

        $user->assignRole($admin);
    }   
}
