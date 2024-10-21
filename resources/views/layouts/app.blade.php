<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventify @yield('titulo')</title>
    @vite('resources/css/layout.css')
    @vite('resources/css/global.css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <h1 class="navbar__title">@yield('titulo')</h1>
        <div class="navbar__links">
            <a href="/" class="navbar__link">Principal</a>
            <a href="/sigin" class="navbar__link">Sign in</a>
            <a href="/login" class="navbar__link">Login</a>
        </div>
    </nav>
    <!-- Content -->
    <div class="content">
        @yield('contenido')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer__content">
            <p class="footer__text">© 2024 Eventify. Todos los derechos reservados.</p>
            <div class="footer__links">
                <a href="/about" class="footer__link">Acerca de</a>
                <a href="/contact" class="footer__link">Contacto</a>
                <a href="/privacy" class="footer__link">Política de Privacidad</a>
            </div>
        </div>
    </footer>
</body>
</html>
