<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('inicio') }}">
                {{ config('app.name', 'Temp API') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="publicNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}" href="{{ route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('vision-mision') ? 'active' : '' }}" href="{{ route('vision-mision') }}">Visi&oacute;n y misi&oacute;n</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('quienes-somos') ? 'active' : '' }}" href="{{ route('quienes-somos') }}">Qui&eacute;nes somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('servicios') ? 'active' : '' }}" href="{{ route('servicios') }}">Nuestros servicios</a>
                    </li>
                </ul>

                <div class="d-flex">
                    @auth
                        <a class="btn btn-outline-light me-2" href="{{ route('home') }}">Privado</a>
                    @endauth
                    @guest
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
