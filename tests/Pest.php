<?php

use App\Models\Thermometer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

uses(TestCase::class)->in('Feature', 'Unit');
uses(RefreshDatabase::class)->in('Feature');

function seedRoles(): void
{
    app(PermissionRegistrar::class)->forgetCachedPermissions();

    Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
    Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
}

function createAdminUser(array $attributes = []): User
{
    seedRoles();

    $user = User::factory()->create($attributes);
    $user->assignRole('admin');

    return $user;
}

function createRegularUser(array $attributes = []): User
{
    seedRoles();

    $user = User::factory()->create($attributes);
    $user->assignRole('user');

    return $user;
}

function createThermometer(array $attributes = [], bool $withPermission = true): Thermometer
{
    $thermometer = Thermometer::create(array_merge([
        'username' => 'thermo_' . fake()->unique()->bothify('####'),
        'password' => 'password123',
    ], $attributes));

    // `has_permission` is not mass assignable in the model.
    DB::table('thermometers')
        ->where('id', $thermometer->id)
        ->update(['has_permission' => $withPermission]);

    return $thermometer->fresh();
}
