<div>
    <form class="authform" wire:submit.prevent="register">
        @csrf
        <h2 class="authform_h2">Registrarse</h2>
        <div class="authform_div">
            <label for="name">Nombre:</label>
            <input class="authform_div-input" type="text" id="name" wire:model="name" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="authform_div">
            <label for="email">Correo Electrónico:</label>
            <input class="authform_div-input" type="email" id="email" wire:model="email" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="authform_div">
            <label for="password">Contraseña:</label>
            <input class="authform_div-input" type="password" id="password" wire:model="password" required>
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="authform_div">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input class="authform_div-input" type="password" id="password_confirmation" wire:model="password_confirmation" required>
            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <button class="authform_btn" type="submit">Registrar</button>
        </div>
    </form>

    <div class="login_div">
        <a href="{{ route('login') }}">
            <button class="login_div-btn">Iniciar Sesión</button>
        </a>
    </div>

    
    @if (session()->has('message'))
        <div class="success">{{ session('message') }}</div>
    @endif
</div>