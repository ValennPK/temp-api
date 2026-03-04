<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class ListUsers extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public string $search = '';
    public string $roleFilter = 'all';
    public string $statusFilter = 'active';
    public int $perPage = 10;
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';

    public bool $showForm = false;
    public bool $isEditing = false;
    public ?int $userId = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $selectedRole = 'user';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedRoleFilter(): void
    {
        $this->resetPage();
    }

    public function updatedStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            return;
        }

        $this->sortField = $field;
        $this->sortDirection = 'asc';
    }

    public function openCreateModal(): void
    {
        if (!$this->isAdmin()) {
            return;
        }

        $this->resetForm();
        $this->showForm = true;
        $this->isEditing = false;
    }

    public function openEditModal(int $id): void
    {
        if (!$this->isAdmin()) {
            return;
        }

        $user = User::withTrashed()->findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedRole = $user->getRoleNames()->first() ?? 'user';
        $this->isEditing = true;
        $this->showForm = true;
    }

    public function saveUser(): void
    {
        if (!$this->isAdmin()) {
            return;
        }

        $validated = $this->validate($this->rules(), $this->messages());

        if ($this->isEditing && $this->userId) {
            $user = User::withTrashed()->findOrFail($this->userId);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            if (!empty($validated['password'])) {
                $user->password = $validated['password'];
            }
            $user->save();
            $user->syncRoles([$validated['selectedRole']]);
            session()->flash('status', 'Usuario actualizado correctamente.');
        } else {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]);
            $user->syncRoles([$validated['selectedRole']]);
            session()->flash('status', 'Usuario creado correctamente.');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function deleteUser(int $id): void
    {
        if (!$this->isAdmin()) {
            return;
        }

        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('status', 'Usuario eliminado correctamente.');
        $this->resetPage();
    }

    public function restoreUser(int $id): void
    {
        if (!$this->isAdmin()) {
            return;
        }

        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        session()->flash('status', 'Usuario restaurado correctamente.');
        $this->resetPage();
    }

    public function closeModal(): void
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function render()
    {
        $roles = Role::query()->orderBy('name')->get();

        if (!$this->isAdmin()) {
            return view('livewire.list-users', [
                'users' => User::query()->whereRaw('1 = 0')->paginate($this->perPage),
                'roles' => $roles,
                'isAdmin' => false,
            ]);
        }

        $query = User::query()->withTrashed()->with('roles');

        if ($this->search !== '') {
            $query->where(function ($subQuery) {
                $subQuery
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->roleFilter !== 'all') {
            $query->whereHas('roles', function ($subQuery) {
                $subQuery->where('name', $this->roleFilter);
            });
        }

        if ($this->statusFilter === 'active') {
            $query->whereNull('deleted_at');
        } elseif ($this->statusFilter === 'deleted') {
            $query->onlyTrashed();
        }

        $users = $query
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.list-users', [
            'users' => $users,
            'roles' => $roles,
            'isAdmin' => true,
        ]);
    }

    private function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'selectedRole' => ['required', 'exists:roles,name'],
        ];

        if ($this->isEditing) {
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
        } else {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        return $rules;
    }

    private function messages(): array
    {
        return [
            'selectedRole.required' => 'Debes seleccionar un rol.',
            'selectedRole.exists' => 'El rol seleccionado no es valido.',
            'password.confirmed' => 'La confirmacion de la contrasena no coincide.',
        ];
    }

    private function resetForm(): void
    {
        $this->resetValidation();
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedRole = 'user';
        $this->isEditing = false;
    }

    private function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->hasRole('admin');
    }
}
