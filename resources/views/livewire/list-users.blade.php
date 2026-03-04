<div>
    @if (!$isAdmin)
        <div class="alert alert-warning mb-0" role="alert">
            No tienes permisos para administrar usuarios.
        </div>
    @else
        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Usuarios</h3>
            <button type="button" class="btn btn-primary" wire:click="openCreateModal">
                Nuevo usuario
            </button>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label" for="user-search">Buscar</label>
                        <input id="user-search" type="text" class="form-control" placeholder="Nombre o email" wire:model.live.debounce.300ms="search">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="role-filter">Rol</label>
                        <select id="role-filter" class="form-select" wire:model.live="roleFilter">
                            <option value="all">Todos</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="status-filter">Estado</label>
                        <select id="status-filter" class="form-select" wire:model.live="statusFilter">
                            <option value="active">Activos</option>
                            <option value="deleted">Eliminados</option>
                            <option value="all">Todos</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="per-page">Por pagina</label>
                        <select id="per-page" class="form-select" wire:model.live="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @if ($showForm)
            <div class="card mb-3">
                <div class="card-header">{{ $isEditing ? 'Editar usuario' : 'Crear usuario' }}</div>
                <div class="card-body">
                    <form wire:submit.prevent="saveUser">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="name">Nombre</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="email">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="role">Rol</label>
                                <select id="role" class="form-select @error('selectedRole') is-invalid @enderror" wire:model.defer="selectedRole">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedRole') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="password">Contrasena</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" wire:model.defer="password">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="password_confirmation">Confirmar contrasena</label>
                                <input id="password_confirmation" type="password" class="form-control" wire:model.defer="password_confirmation">
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-success">
                                {{ $isEditing ? 'Actualizar' : 'Crear' }}
                            </button>
                            <button type="button" class="btn btn-outline-secondary" wire:click="closeModal">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr>
                        <th role="button" wire:click="sortBy('id')">ID</th>
                        <th role="button" wire:click="sortBy('name')">Nombre</th>
                        <th role="button" wire:click="sortBy('email')">Email</th>
                        <th>Rol</th>
                        <th role="button" wire:click="sortBy('created_at')">Creado</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="{{ $user->deleted_at ? 'table-secondary' : '' }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames()->implode(', ') ?: '-' }}</td>
                            <td>{{ $user->created_at?->format('Y-m-d H:i') }}</td>
                            <td>{{ $user->deleted_at ? 'Eliminado' : 'Activo' }}</td>
                            <td class="text-end">
                                @if ($user->deleted_at)
                                    <button type="button" class="btn btn-sm btn-outline-success" wire:click="restoreUser({{ $user->id }})">
                                        Restaurar
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm btn-outline-primary" wire:click="openEditModal({{ $user->id }})">
                                        Editar
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deleteUser({{ $user->id }})" onclick="return confirm('Seguro que quieres eliminar este usuario?')">
                                        Eliminar
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No hay usuarios para mostrar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    @endif
</div>
