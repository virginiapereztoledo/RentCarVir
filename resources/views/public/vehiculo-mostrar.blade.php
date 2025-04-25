@extends("public.layout.public-layout")
@section("title", "Vehículo - " . $vehiculo->marca . " - " .$vehiculo->modelo)

@section("content")
    <div class="container mt-5">
        <div class="mb-5">
            <a class="btn btn-dark" href="{{ url()->previous() }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle-fill me-1" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
                Volver
            </a>
        </div>

        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset($vehiculo->foto) }}" class="card-img-top" alt="Imagen del vehículo">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h2 class="card-title1">{{$vehiculo->marca . " - " .$vehiculo->modelo}}</h2>
                        <p class="card-text1"><strong>Costo diario:</strong> {{$vehiculo->costoDiario}} €</p>
                        <p class="card-text1"><strong>Vencimiento:</strong> {{$vehiculo->vencimiento}}</p>
                        <hr>
                        <h4>Configuración</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Motor:</strong> {{$vehiculo->motor}}</li>
                            <li class="list-group-item"><strong>Puertas:</strong> {{$vehiculo->puertas}}</li>
                            <li class="list-group-item"><strong>Equipamiento:</strong> {{$vehiculo->equipamiento}}</li>
                            <li class="list-group-item"><strong>Cambio:</strong> {{$vehiculo->cambio}}</li>
                            <li class="list-group-item"><strong>Asientos:</strong> {{$vehiculo->asientos}}</li>
                        </ul>

                        @if ($vehiculo->descripcion != null)
                            <div class="mt-3">
                                <h5>Descripción:</h5>
                                <p>{{$vehiculo->descripcion}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
