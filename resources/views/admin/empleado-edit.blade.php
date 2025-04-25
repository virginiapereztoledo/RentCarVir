@extends("admin.layout.admin-layout")
@section("title", "Empleado - Modificar")

@push('javascript')
<script src="{{ asset('js/image-edit.js') }}"></script>
@endpush

@section("content")
<div class="container mt-5">
    <section class="management-section">
        @if ($message = Session::get('success'))
        <div class="alert alert-success text-center">{{ $message }}</div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <p>Atención: Ocurrieron los siguientes errores:</p>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


            <div class="form-container">
                <div class="form-heading d-flex align-items-center mb-4">
                    <a href="{{ route('empleado.index') }}" class="btn btn-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg>
                    </a>
                    <h1 class="ms-3">Modificar Empleado</h1>
                </div>

                <form action="{{ route('empleado.update', $empleado) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-input mb-3">
                        <div class="form-group mb-3">
                            @include("components.image-item", ["size" => "100px", "path" => $empleado->foto, "id" => "foto"])
                        </div>
                        <div class="form-group mb-3">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ $empleado->usuario->username }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="nombre">Nome:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $empleado->nombre }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control" value="{{ $empleado->apellidos }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password: (Opcional)</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirmar password: (Opcional)</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="form-button d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary me-2">Reset</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
    </section>
</div>
@endsection
