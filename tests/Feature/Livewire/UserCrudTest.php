<?php

use App\Livewire\ListUsers;
use App\Models\User;
use Livewire\Livewire;

it('deniega la gestion de usuarios a usuarios no admin', function () {
    $user = createRegularUser();

    $this->actingAs($user);

    Livewire::test(ListUsers::class)
        ->assertSee('No tienes permisos para administrar usuarios.');
});

it('permite a admin crear editar eliminar y restaurar usuarios', function () {
    $admin = createAdminUser();
    $this->actingAs($admin);

    Livewire::test(ListUsers::class)
        ->call('openCreateModal')
        ->set('name', 'Usuario Test')
        ->set('email', 'usuario.test@example.com')
        ->set('selectedRole', 'user')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('saveUser')
        ->assertHasNoErrors();

    $createdUser = User::where('email', 'usuario.test@example.com')->first();

    expect($createdUser)->not->toBeNull();
    expect($createdUser->hasRole('user'))->toBeTrue();

    Livewire::test(ListUsers::class)
        ->call('openEditModal', $createdUser->id)
        ->set('name', 'Usuario Editado')
        ->set('email', 'usuario.editado@example.com')
        ->set('selectedRole', 'editor')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('saveUser')
        ->assertHasNoErrors();

    $createdUser->refresh();
    expect($createdUser->name)->toBe('Usuario Editado');
    expect($createdUser->email)->toBe('usuario.editado@example.com');
    expect($createdUser->hasRole('editor'))->toBeTrue();

    Livewire::test(ListUsers::class)
        ->call('deleteUser', $createdUser->id);

    $this->assertSoftDeleted('users', ['id' => $createdUser->id]);

    Livewire::test(ListUsers::class)
        ->call('restoreUser', $createdUser->id);

    $this->assertNotSoftDeleted('users', ['id' => $createdUser->id]);
});

it('filtra usuarios por busqueda rol y estado', function () {
    $admin = createAdminUser(['name' => 'Admin Master']);
    $this->actingAs($admin);

    $editor = User::factory()->create([
        'name' => 'Carlos Editor',
        'email' => 'carlos.editor@example.com',
    ]);
    $editor->assignRole('editor');

    $normal = User::factory()->create([
        'name' => 'Ana User',
        'email' => 'ana.user@example.com',
    ]);
    $normal->assignRole('user');
    $normal->delete();

    Livewire::test(ListUsers::class)
        ->set('search', 'Carlos')
        ->assertSee('Carlos Editor')
        ->assertDontSee('Ana User');

    Livewire::test(ListUsers::class)
        ->set('roleFilter', 'editor')
        ->assertSee('Carlos Editor')
        ->assertDontSee('Ana User');

    Livewire::test(ListUsers::class)
        ->set('statusFilter', 'deleted')
        ->assertSee('Ana User')
        ->assertDontSee('Carlos Editor');
});
