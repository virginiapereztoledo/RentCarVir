@extends(Auth::user()->utenteable_type == "Admin" ? "admin.layout.admin-layout" : "empleado.layout.empleado-layout")
@section("title", "Vehículo - Añadir")

@section("content")
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <p>¡ATENCIÓN! Se han producido los siguientes errores:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="oscuro">Añadir Vehículo</h2>
                <a href="{{ route('vehiculo.index') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-left-circle-fill me-1" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    Regresar
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('vehiculo.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matrícula:</label>
                        <input type="text" id="matricula" name="matricula" class="form-control" value="{{ old('matricula') }}">
                    </div>

                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo:</label>
                        <input type="text" id="modelo" name="modelo" class="form-control" value="{{ old('modelo') }}">
                    </div>

                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca:</label>
                        <input type="text" id="marca" name="marca" class="form-control" value="{{ old('marca') }}">
                    </div>

                    <div class="mb-3">
                        <label for="motor" class="form-label">Motor:</label>
                        <input type="text" id="motor" name="motor" class="form-control" value="Hibrido" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="cambio" class="form-label">Cambio:</label>
                        <select id="cambio" name="cambio" class="form-select">
                            <option value="Automatico" {{ old('cambio') == 'Automatico' ? 'selected' : '' }}>Automatico</option>
                            <option value="Manual" {{ old('cambio') == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="equipamiento" class="form-label">Equipamiento:</label>
                        <input type="text" id="equipamiento" name="equipamiento" class="form-control" value="{{ old('equipamiento') }}">
                    </div>

                    <div class="mb-3">
                        <label for="puertas" class="form-label">Puertas:</label>
                        <select id="puertas" name="puertas" class="form-select">
                            <option value="4" {{ old('puertas') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('puertas') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="asientos" class="form-label">Asientos:</label>
                        <select id="asientos" name="asientos" class="form-select">
                            @for ($i = 2; $i <= 9; $i++)
                                <option value="{{ $i }}" {{ old('asientos') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="autonomia" class="form-label">Autonomía:</label>
                        <div class="input-group">
                            <input type="number" id="autonomia" name="autonomia" class="form-control" step="0.01" value="{{ old('autonomia') }}">
                            <span class="input-group-text">km</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" id="color" name="color" class="form-control" value="{{ old('color') }}">
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto:</label>
                        <input type="file" id="foto" name="foto" class="form-control" accept=".jpg, .jpeg, .png">
                    </div>

                    <div class="mb-3">
                        <label for="emision" class="form-label">Disponibilidad desde:</label>
                        <input type="date" id="emision" name="emision" class="form-control" value="{{ old('emision') }}">
                    </div>

                    <div class="mb-3">
                        <label for="vencimiento" class="form-label">Disponibilidad hasta:</label>
                        <input type="date" id="vencimiento" name="vencimiento" class="form-control" value="{{ old('vencimiento') }}">
                    </div>

                    <div class="mb-3">
                        <label for="costoDiario" class="form-label">Costo diario:</label>
                        <div class="input-group">
                            <input type="number" id="costoDiario" name="costoDiario" class="form-control" step="0.01" value="{{ old('costoDiario') }}">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción: (opcional)</label>
                        <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-secondary">Reiniciar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
