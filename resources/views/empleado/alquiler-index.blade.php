@extends(Auth::user()->utenteable_type == "Admin" ? "admin.layout.admin-layout" : "empleado.layout.empleado-layout")
@section("title", "Alquiler - Estadísticas")

@section("content")
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <p>¡ATENCIÓN! Se han producido los siguientes errores:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="management-section">
        <div class="container">
            <div class="d-flex justify-content-between mb-3">
                <h2>Alquileres</h2>
            </div>

            <form action="{{ route('alquiler.month') }}" method="POST" class="d-flex justify-content-center align-items-center mb-4">
                @csrf
                <label for="mes" class="form-label me-2">Mes:</label>
                <select name="mes" id="mes" class="form-select" onchange="this.form.submit()">
                    <option value="0" {{ app('request')->input('mes') == 0 ? 'selected' : '' }}>Cualquiera</option>
                    <option value="1" {{ app('request')->input('mes') == 1 ? 'selected' : '' }}>Enero</option>
                    <option value="2" {{ app('request')->input('mes') == 2 ? 'selected' : '' }}>Febrero</option>
                    <option value="3" {{ app('request')->input('mes') == 3 ? 'selected' : '' }}>Marzo</option>
                    <option value="4" {{ app('request')->input('mes') == 4 ? 'selected' : '' }}>Abril</option>
                    <option value="5" {{ app('request')->input('mes') == 5 ? 'selected' : '' }}>Mayo</option>
                    <option value="6" {{ app('request')->input('mes') == 6 ? 'selected' : '' }}>Junio</option>
                    <option value="7" {{ app('request')->input('mes') == 7 ? 'selected' : '' }}>Julio</option>
                    <option value="8" {{ app('request')->input('mes') == 8 ? 'selected' : '' }}>Agosto</option>
                    <option value="9" {{ app('request')->input('mes') == 9 ? 'selected' : '' }}>Septiembre</option>
                    <option value="10" {{ app('request')->input('mes') == 10 ? 'selected' : '' }}>Octubre</option>
                    <option value="11" {{ app('request')->input('mes') == 11 ? 'selected' : '' }}>Noviembre</option>
                    <option value="12" {{ app('request')->input('mes') == 12 ? 'selected' : '' }}>Diciembre</option>
                </select>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha de Retiro</th>
                        <th>Fecha de Entrega</th>
                        <th>Matrícula del Coche</th>
                        <th>Modelo del Coche</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alquileres as $alquiler)
                        <tr>
                            <td>{{ $alquiler->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($alquiler->fechaRecogida)->format("d-m-Y") }}</td>
                            <td>{{ \Carbon\Carbon::parse($alquiler->fechaEntrega)->format("d-m-Y") }}</td>
                            <td>{{ $alquiler->vehiculo->matricula }}</td>
                            <td>{{ $alquiler->vehiculo->modelo }}</td>
                            <td>
                                @if ($alquiler->cliente && $alquiler->cliente->usuario)
                                    {{ $alquiler->cliente->usuario->username }}
                                @else
                                    Cliente no disponible
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No hay Resultados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
