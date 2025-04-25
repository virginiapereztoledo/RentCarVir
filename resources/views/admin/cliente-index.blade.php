@extends("admin.layout.admin-layout")
@section("title", "Cliente - Gestión")
@push('javascript')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/delete.js') }}"></script>
    <script src="{{ asset('js/delete-cliente.js') }}"></script>
@endpush
@section("content")
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Gestión Clientes</h2>
            <!-- Formulario con estilo de Bootstrap -->
            <form action="{{ route('cliente.deleteAll') }}" method="POST">
                @csrf
                <button id="delete-all" type="button" class="btn btn-danger">
                    Eliminar todos
                </button>
            </form>
        </div>

        <div id="table_data" data-route="{{ route('cliente.index') }}">
            @include('admin.client-table')
        </div>
    </div>
@endsection
