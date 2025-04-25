<nav class="navbar navbar-expand-lg navbar-light bg-light mt-5">
    <div class="container-fluid">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a href="{{ route('empleado.index') }}" class="nav-link {{ request()->routeIs('empleado.index') ? 'active' : '' }}">Gestión Empleado</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('cliente.index') }}" class="nav-link {{ request()->routeIs('cliente.index') ? 'active' : '' }}">Gestión Cliente</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('vehiculo.index') }}" class="nav-link {{ request()->routeIs('vehiculo.index') ? 'active' : '' }}">Gestión Vehículo</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('alquiler.year') }}" class="nav-link {{ request()->routeIs('alquiler.year') ? 'active' : '' }}">Alquileres</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('estadisticas') }}" class="nav-link {{ request()->routeIs('estadisticas') ? 'active' : '' }}">Estadísticas</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('localizacion') }}" class="nav-link {{ request()->routeIs('localizacion') ? 'active' : '' }}">Localizacion</a>
            </li>
        </ul>
    </div>
</nav>
