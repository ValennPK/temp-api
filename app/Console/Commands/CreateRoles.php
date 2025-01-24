<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create roles and permissions';

    /**
     * Execute the console command.
     */
    public function handle()
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
    }
}
