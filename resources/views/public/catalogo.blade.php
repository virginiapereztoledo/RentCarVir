@extends("public.layout.public-layout")
@section("title", "Catálogo")
@push('javascript')
<script src="{{asset("js/catalogo.js")}}"></script>
@endpush
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

    <section class="container my-5 pt-4">
        <div class="text-center mb-4">
            <h1>Explora nuestro Catálogo de Coches</h1>
            <p>
                Descubre nuestra amplia gama de vehículos disponibles para alquiler.
                Desde turismos hasta furgonetas, tenemos algo para cada necesidad con los mejores precios.
                Encuentra el coche perfecto para tu próximo viaje y realiza una reserva fácil y rápida.
            </p>
        </div>

        <section class="search-section">
            <form action="{{ route('catalogo') }}" method="GET" class="mb-5 mt-5">
                <div class="input-group">
                    <input type="search" id="search" name="search" class="form-control" placeholder="Introduzca la marca o modelo del vehículo para alquilar" value="{{ request()->input('search') }}">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>

                <div id="toggle-filter" class="mt-3">
                    <div class="row">
                        <div class="col-md-4">
                            <h5>Rango de precios</h5>
                            <div class="mb-2">
                                <div class="input-group">
                                    <input type="number" id="priceMin" name="priceMin" class="form-control" placeholder="Mínimo"
                                        min="1" max="500" value="{{ request()->input('priceMin', 1) }}">
                                    <span class="input-group-text">-</span>
                                    <input type="number" id="priceMax" name="priceMax" class="form-control" placeholder="Máximo"
                                        min="1" max="500" value="{{ request()->input('priceMax', 500) }}">
                                </div>


                            </div>
                        </div>


                        <div class="col-md-4">
                            <h5>Filtrar por número de asientos/plazas</h5>
                            <select name="asientos" id="asientos" class="form-select mb-3">
                                <option value="">No especificado</option>
                                <option value="2" {{ request()->input('asientos') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ request()->input('asientos') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ request()->input('asientos') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ request()->input('asientos') == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ request()->input('asientos') == '6' ? 'selected' : '' }}>6</option>
                                <option value="7" {{ request()->input('asientos') == '7' ? 'selected' : '' }}>7</option>
                            </select>
                        </div>

                        @can('isClient')
                        <div class="col-md-4">
                            <h5>Recogida y entrega de vehículos</h5>
                            <div class="mb-2">
                                <select name="lugarRecogida" id="lugarRecogida" class="form-select mb-3">
                                    <option value="Fuengirola" {{ request()->input('lugarRecogida') == 'Fuengirola' ? 'selected' : '' }}>Fuengirola</option>
                                </select>

                                <input type="date" id="fechaRecogida" name="fechaRecogida" class="form-control mb-2" value="{{ request()->input('fechaRecogida') }}">
                                <select name="horaRecogida" class="form-select">
                                    <option value="08:00" {{ request()->input('horaRecogida') == '08:00' ? 'selected' : '' }}>08:00</option>
                                    <option value="08:30" {{ request()->input('horaRecogida') == '08:30' ? 'selected' : '' }}>08:30</option>
                                    <option value="09:00" {{ request()->input('horaRecogida') == '09:00' ? 'selected' : '' }}>09:00</option>
                                    <option value="09:30" {{ request()->input('horaRecogida') == '09:30' ? 'selected' : '' }}>09:30</option>

                                </select>
                            </div>

                            <div>
                                <label for="lugarEntrega" class="form-label">Entrega:</label>
                                <select name="lugarEntrega" class="form-select mb-3">
                                    <option value="Fuengirola" {{ request()->input('lugarEntrega') == 'Fuengirola' ? 'selected' : '' }}>Fuengirola</option>

                                </select>
                                <input type="date" id="fechaEntrega" name="fechaEntrega" class="form-control mb-2" value="{{ request()->input('fechaEntrega') }}">
                                <select name="horaEntrega" class="form-select">
                                    <option value="08:00" {{ request()->input('horaEntrega') == '08:00' ? 'selected' : '' }}>08:00</option>
                                    <option value="08:30" {{ request()->input('horaEntrega') == '08:30' ? 'selected' : '' }}>08:30</option>

                                </select>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button class="btn btn-secondary" type="reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </section>

        @if ($message = Session::get('empty'))
        <div class="alert alert-info text-center">{{ $message }}</div>
        @endif

        <section class="result-section">
            <div class="row">
                @foreach($result as $alquiler)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 {{ $alquiler->disponible}}">
                        <img src="{{ asset($alquiler->foto) }}" class="card-img-top" alt="Imagen del vehículo">
                        <div class="card-body">
                            <h5 class="card-title1">{{ $alquiler->modelo }}</h5>
                            <p class="card-text1">{{ $alquiler->marca }}</p>
                            <p class="card-text1"><strong>Precio diario:</strong> {{ $alquiler->costoDiario }} €</p>
                            <a href="{{ route('vehiculo.mostrar', $alquiler->id) }}" class="btn btn-info">Ver más</a>

                            <ul class="list-group list-group-flush mt-3">
                                <li class="list-group-item"><strong>Motor:</strong> {{ $alquiler->motor }}</li>
                                <li class="list-group-item"><strong>Puertas:</strong> {{ $alquiler->puertas }}</li>
                                <li class="list-group-item"><strong>Equipamiento:</strong> {{ $alquiler->equipamiento }}</li>
                                <li class="list-group-item"><strong>Cambio:</strong> {{ $alquiler->cambio }}</li>
                                <li class="list-group-item"><strong>Asientos:</strong> {{ $alquiler->asientos }}</li>
                            </ul>

                            @can("isClient")
                            @if ($alquiler->disponible)
                            <form action="{{ route('reservar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ Crypt::encrypt($alquiler->id) }}">
                                <input type="hidden" name="fechaRecogida" value="{{ Crypt::encrypt(request()->input('fechaRecogida')) }}">
                                <input type="hidden" name="lugarRecogida" value="{{ Crypt::encrypt(request()->input('lugarRecogida')) }}">
                                <input type="hidden" name="horaRecogida" value="{{ Crypt::encrypt(request()->input('horaRecogida')) }}">
                                <input type="hidden" name="fechaEntrega" value="{{ Crypt::encrypt(request()->input('fechaEntrega')) }}">
                                <input type="hidden" name="lugarEntrega" value="{{ Crypt::encrypt(request()->input('lugarEntrega')) }}">
                                <input type="hidden" name="horaEntrega" value="{{ Crypt::encrypt(request()->input('horaEntrega')) }}">
                                <button class="btn btn-primary mt-2" type="submit">Reservar</button>
                            </form>
                            @else
                            <p class="text-danger mt-4">No disponible</p>
                            @endif
                            @endcan
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if ($result != [])
            <div class="d-flex justify-content-center">
                {{ $result->withQueryString()->links('components.pagination') }}
            </div>
            @endif
        </section>
</div>
@endsection
