@extends("public.layout.public-layout")
@section("title", "Login")
@section("content")
<div class="vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow p-4" style="width: 700px; border-radius: 8px;">
        <div class="text-center mb-4">
            <svg class="bi bi-person" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
            </svg>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
                @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            ¿No tienes una cuenta? <a class="link-primary" href="{{ route('register') }}">Registrate aquí</a>
        </p>
    </div>
</div>
@endsection
