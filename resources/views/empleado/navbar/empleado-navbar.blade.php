<nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
    <div class="container-fluid">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a href="{{ route('vehiculo.index') }}" class="nav-link {{ request()->routeIs('vehiculo.index') ? 'active' : '' }}">Gestión Vehículo</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('alquiler.year') }}" class="nav-link {{ request()->routeIs('alquiler.year') ? 'active' : '' }}">Ver Alquileres</a>
            </li>
        </ul>
    </div>
</nav>
