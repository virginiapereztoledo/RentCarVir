<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield("title")</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar Mejorado -->
    <header data-bs-theme="light">
        <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <span class="fas fa-home" aria-hidden="true"></span>
                    <span class="sr-only">Inicio</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('condiciones') ? 'active' : '' }}" href="{{ route('condiciones') }}">Condiciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}" href="{{ route('contacto') }}">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('catalogo') ? 'active' : '' }}" href="{{ route('catalogo') }}">Catálogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Quiénes somos</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cliente.edit.profile') ? 'active' : '' }}" href="@can('isClient'){{ route('cliente.edit.profile') }}@endcan @can('isEmpleado'){{ route('vehiculo.index') }}@endcan @can('isAdmin'){{ route('cliente.index') }}@endcan">Zona personal</a>
                        </li>
                        @endauth
                    </ul>
                </div>

                <div class="main-nav-link-btn d-flex gap-2">
                    @guest
                    <a id="btn-login" class="btn btn-outline-primary" href="{{ route('login') }}">Iniciar sesión</a>
                    <a id="btn-signup" class="btn btn-primary" href="{{ route('register') }}">Registro</a>
                    @else
                    <a id="btn-logout" class="btn btn-outline-danger" href="{{ route('logout') }}">Salir</a>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- Video de fondo -->
    <div class="video-background">
        <video muted autoplay loop loading="lazy">
            <source src="{{ asset('video/bosque2.mp4') }}" type="video/mp4">
        </video>
    </div>




</body>
</html>
