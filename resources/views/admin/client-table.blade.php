<div class="container mt-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Username</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Domicilio</th>
                <th>Ocupación</th>
                <th>Fecha de nacimiento</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>
                        <img class="img-thumbnail" src="{{ asset($cliente->foto) }}" alt="Foto de cliente" width="50" height="50">
                    </td>
                    <td>
                        @if($cliente->usuario)
                            {{ $cliente->usuario->username }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->domicilio }}</td>
                    <td>{{ $cliente->ocupacion }}</td>
                    <td>{{ $cliente->fechaNacimiento }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button id="{{ $cliente->id }}" data-username="{{ $cliente->usuario ? $cliente->usuario->username : '' }}" type="button" class="btn btn-danger btn-sm client-to-delete">
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No hay resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        {!! $clientes->links('components.pagination') !!}
    </div>
</div>
<script>
    // Defino la variable deleteUrl en el archivo JavaScript
    const deleteUrl = "{{ route('cliente.delete') }}";
</script>

