@extends("cliente.layout.cliente-layout")
@section("title", "Cliente - Perfil")

@section("content")
<div class="container mt-5">
    @if ($message = Session::get('success'))
    <div class="alert alert-success text-center">{{ $message }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger text-center">{{$message }}
        <p>¡ATENCIÓN! Ocurrieron los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Diseño de la tarjeta -->
    <div class="card shadow-sm p-4 mb-4">
        <h1 class="mb-3">Datos personales</h1>

        <!-- Formulario de datos personales -->
        <form action="{{ route('cliente.update.profile') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nombre y apellidos -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ Auth::user()->utenteable ? Auth::user()->utenteable->nombre : '' }}" required>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" value="{{ Auth::user()->utenteable ? Auth::user()->utenteable->apellidos : '' }}" required>
            </div>

            <!-- Username y domicilio -->
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
            </div>
            <div class="mb-3">
                <label for="domicilio" class="form-label">Domicilio:</label>
                <input type="text" id="domicilio" name="domicilio" class="form-control" value="{{ Auth::user()->utenteable ? Auth::user()->utenteable->domicilio : '' }}">
            </div>

            <!-- Ocupación y fecha de nacimiento -->
            <div class="mb-3">
                <label for="ocupacion" class="form-label">Ocupación:</label>
                <select id="ocupacion" name="ocupacion" class="form-select">
                    <option value="No especificado" {{ Auth::user()->utenteable && Auth::user()->utenteable->ocupacion == 'No especificado' ? 'selected' : '' }}>No especificado</option>
                    <option value="Trabajador" {{ Auth::user()->utenteable && Auth::user()->utenteable->ocupacion == 'Trabajador' ? 'selected' : '' }}>Trabajador</option>
                    <option value="Autónomo" {{ Auth::user()->utenteable && Auth::user()->utenteable->ocupacion == 'Autónomo' ? 'selected' : '' }}>Autónomo</option>
                    <option value="Estudiante" {{ Auth::user()->utenteable && Auth::user()->utenteable->ocupacion == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                    <option value="Desempleado" {{ Auth::user()->utenteable && Auth::user()->utenteable->ocupacion == 'Desempleado' ? 'selected' : '' }}>Desempleado</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" value="{{ Auth::user()->utenteable ? Auth::user()->utenteable->fechaNacimiento : '' }}">
            </div>

            <!-- Botones de acción -->
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-light me-2">Restablecer</button>
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </form>
    </div>
</div>
@endsection
