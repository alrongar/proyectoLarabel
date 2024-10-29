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

    @yield("css")

    <!-- Scripts -->
    @vite(['resources/scss/nav-foot.scss','resources/scss/app.scss','resources/scss/-variables.scss',
            'resources/scss/login.scss','resources/scss/register.scss','resources/scss/admin.scss',
            'resources/scss/update.scss'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="app" class="app">
        <nav class="app__navbar navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="app__navbar-brand navbar-brand" href="{{ url('/') }}">
                    Eventify  <!-- Cambiado de Laravel a Eventify -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ms-auto">
                        @if (Auth::check() && Auth::user()->rol === 'a')
                            <li class="nav-item"> 
                                <a href="{{ route('admin.users') }}" class="nav-link">{{ __('Admin Panel') }}</a>
                            </li>
                        @endif
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}">{{ __('Edit Profile') }}</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="app__main py-4">
            @yield('content')
        </main>

        <footer class="app__footer">
            <div class="app__footer-content container">
                <p class="app__footer-text">{{ __('© 2024 Event App - All rights reserved') }}</p>
                <div class="app__footer-links">
                    <a href="#" class="app__footer-link">{{ __('Privacy Policy') }}</a>
                    <a href="#" class="app__footer-link">{{ __('Terms of Service') }}</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
