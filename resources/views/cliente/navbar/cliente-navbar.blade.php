<nav class="client-navbar navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('cliente.edit.profile') ? 'active' : '' }}" href="{{route('cliente.edit.profile')}}" data-title="Cliente - Perfil">
                Cuenta
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('cliente.edit.password') ? 'active' : '' }}" href="{{route('cliente.edit.password')}}" data-title="Cliente - Password">
                Password
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('cliente.alquiler') ? 'active' : '' }}" href="{{route('cliente.alquiler')}}" data-title="Cliente - Alquiler">
                Alquiler
            </a>
        </li>
    </ul>
</nav>
