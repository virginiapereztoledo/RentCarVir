@extends(Auth::user()->utenteable_type == "Admin" ? "admin.layout.admin-layout" : "empleado.layout.empleado-layout")
@section("title", "Vehículo - Gestión")

@push('javascript')
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush

@section("content")
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Gestión vehículo</h2>
            <a href="{{ route('vehiculo.create') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill me-1" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                Añadir
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Matrícula</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Costo diario</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehiculos as $vehiculo)
                        <tr>
                            <td>
                                <img src="{{ asset($vehiculo->foto) }}" alt="Foto de vehículo" width="50" height="50">
                            </td>
                            <td>{{ $vehiculo->matricula }}</td>
                            <td>{{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->marca }}</td>
                            <td>{{ $vehiculo->costoDiario }} €</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('vehiculo.mostrar', $vehiculo) }}" class="btn btn-warning">
                                        Detalles
                                    </a>
                                    <a href="{{ route('vehiculo.edit', $vehiculo) }}" class="btn btn-primary">
                                        Modificar
                                    </a>
                                    <form action="{{ route('vehiculo.destroy', $vehiculo) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Sin resultados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $vehiculos->links('components.pagination') }}
            </div>
        </div>
    </div>
@endsection
