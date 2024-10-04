<div>
    <form wire:submit.prevent="register">
        @csrf
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" wire:model="name" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" wire:model="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" wire:model="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" required>
            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit">Registrar</button>
        </div>
    </form>
    
    @if (session()->has('message'))
        <div class="success">{{ session('message') }}</div>
    @endif
</div>
