@extends("cliente.layout.cliente-layout")
@section("title", "Cliente - Modificar Password")

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
            <h1 class="mb-3">Modificar Password</h1>

            <!-- Formulario de modificación de contraseña -->
            <form action="{{ route('cliente.update.password') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campo de contraseña anterior -->
                <div class="mb-3">
                    <label for="oldPassword" class="form-label">Contraseña anterior:</label>
                    <input type="password" id="oldPassword" name="oldPassword" class="form-control" required>
                </div>

                <!-- Nueva contraseña y confirmación -->
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Nueva contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmar nueva contraseña:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
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
