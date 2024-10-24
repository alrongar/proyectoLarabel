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
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    @yield("css")

    <!-- Scripts -->
    @vite(['resources/css/global.css', 'resources/js/app.js','resources/scss/principal.scss','resources/scss/home.scss'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar__brand navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar__toggler navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar__collapse collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar__nav navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar__nav navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @if (Auth::check() && Auth::user()->rol === 'a')
                            <a href="{{ route('admin.users') }}" class="button button--link">
                                {{ __('Admin Panel') }}
                            </a>
                        @endif
                        @guest
                            @if (Route::has('login'))
                                <li class="navbar__item nav-item">
                                    <a class="navbar__link nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="navbar__item nav-item">
                                    <a class="navbar__link nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="navbar__item nav-item dropdown">
                                <a id="navbarDropdown" class="navbar__link nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="navbar__dropdown dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="navbar__dropdown-item dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main py-4">
            @yield('content')
        </main>

        <footer class="footer">
            <div class="footer__content container">
                <p class="footer__text">{{ __('© 2024 Event App - All rights reserved') }}</p>
                <div class="footer__links">
                    <a href="#" class="footer__link">{{ __('Privacy Policy') }}</a>
                    <a href="#" class="footer__link">{{ __('Terms of Service') }}</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
