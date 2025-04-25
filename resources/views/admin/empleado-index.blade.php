@extends("admin.layout.admin-layout")
@section("title", "Empleado - Gestión")

@push('javascript')
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush

@section("content")
    <section class="management-section">
        <div class="container mt-4">
            <div class="d-flex justify-content-between mb-3">
                <h2>Gestión Empleado</h2>
                <a href="{{ route('empleado.create') }}" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill me-1" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                    Añadir
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Username</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->id }}</td>
                                <td>
                                    <img class="img-thumbnail" width="50" height="50" src="{{ asset($empleado->foto) }}" alt="Foto del empleado">
                                </td>
                                <td>{{ $empleado->usuario->username }}</td>
                                <td>{{ $empleado->nombre }}</td>
                                <td>{{ $empleado->apellidos }}</td>
                                <td class="action">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('empleado.edit', $empleado->id) }}" class="btn btn-primary">
                                            Modificar
                                        </a>
                                        <form action="{{ route('empleado.destroy', $empleado->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button id="{{ $empleado->id }}" type="submit" class="btn btn-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No hay resultados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $empleados->links('components.pagination') }}
                </div>
            </div>
        </div>
    </section>
@endsection
