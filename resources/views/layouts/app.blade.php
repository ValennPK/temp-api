<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand mb-0" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm ms-2 d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Abrir navegaci&oacute;n">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5Zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5Zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5Z"/>
                                </svg>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('home') && request()->query('seccion', 'termometros') === 'termometros' ? 'active' : '' }}"
                                       href="{{ route('home', ['seccion' => 'termometros']) }}">
                                        Term&oacute;metros
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('home') && request()->query('seccion') === 'usuarios' ? 'active' : '' }}"
                                       href="{{ route('home', ['seccion' => 'usuarios']) }}">
                                        Usuarios
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        @guest
                            @if (Route::has('login'))
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endif

                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </li>
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
