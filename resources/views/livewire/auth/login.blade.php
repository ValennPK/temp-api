<div>
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="login" class="authform">
        @csrf
        <h2 class="authform_h2">Iniciar Sesión</h2>
        <div class="authform_div">
            <label for="email">Email:</label>
            <input class="authform_div-input" type="email" id="email" wire:model="email" required>
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <div class="authform_div">
            <label for="password">Password:</label>
            <input class="authform_div-input" type="password" id="password" wire:model="password" required>
            @error('password') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <button class="authform_btn" type="submit">Login</button>
        </div>
    </form>

    <div class="register_div">
        <a href="{{ route('register') }}">
            <button class="register_div-btn">Crear cuenta</button>
        </a>
    </div>
</div>
