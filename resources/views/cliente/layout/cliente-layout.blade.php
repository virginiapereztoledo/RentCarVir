<!DOCTYPE html>
<html lang="es">

<head>
    <title>
        @yield("title")
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include("public.navbar.main-navbar")
    @if ($errors->any())
    <div class="alert alert-danger">
        <p>ATENCIÓN: Ocurrieron los siguientes errores:</p>
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                <p>{{ $error }}</p>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    @if ($message = Session::get('success'))
    <p class="alert alert-success">{{ $message }}</p>
    @endif

    <section class="container my-5 pt-4">
        <div class="text-center mb-4">
            <div class="left-menu">
                <h2>{{ Auth::user()->username }}</h2>
                <form action="{{ route('cliente.update.image') }}" method="POST" enctype="multipart/form-data" onchange="this.submit()">
                    @csrf
                    @method('PUT')
                    @include("components.image-item", ["size" => "200px", "path" => Auth::user()->utenteable->foto, "id" => "foto"])
                </form>
                @include("cliente.navbar.cliente-navbar")
            </div>

            <div class="right-menu">
                <div class="schede">
                    @yield("content")
                </div>
            </div>
        </div>
    </section>
</body>

</html>
