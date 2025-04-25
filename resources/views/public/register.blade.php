@extends("public.layout.public-layout")
@section("title", "Sign up")
@section("content")
<div class="vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow p-4" style="width: 700px; border-radius: 8px;">
        <div class="text-center mb-4">
            <svg class="bi bi-person" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
            </svg>
        </div>

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf

            <!-- Columna izquierda -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}">
                    @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
                    @error('apellidos')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="domicilio" class="form-label">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio" class="form-control" value="{{ old('domicilio') }}">
                    @error('domicilio')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="ocupacion" class="form-label">Ocupación:</label>
                    <select id="ocupacion" name="ocupacion" class="form-select">
                        <option value="No especificado" {{ old('ocupacion') == 'No especificado' ? 'selected' : '' }}>No especificado</option>
                        <option value="Empleado" {{ old('ocupacion') == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                        <option value="Autónomo" {{ old('ocupacion') == 'Autónomo' ? 'selected' : '' }}>Autónomo</option>
                        <option value="Estudiante" {{ old('ocupacion') == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                        <option value="Desempleado" {{ old('ocupacion') == 'Desempleado' ? 'selected' : '' }}>Desempleado</option>
                    </select>
                    @error('ocupacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento') }}">
                    @error('fechaNacimiento')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
                    @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirma password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" class="form-control">
                    @error('foto')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Registrarse</button>
            </div>
        </form>

        <p class="text-center mt-3">
            ¿Ya tienes una cuenta? <a class="link-primary" href="{{ route('login') }}">Inicia sesión aquí</a>
        </p>
    </div>
</div>
@endsection
