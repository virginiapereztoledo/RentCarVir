@extends("public.layout.public-layout")
@section("title", "Home")
@section("content")

<!-- Video de fondo -->
<div class="video-background">
    <video muted autoplay loop loading="lazy">
        <source src="{{ asset('video/bosque2.mp4') }}" type="video/mp4">
    </video>
</div>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-container">
        <h2>Rent Car Vir</h2>
        <p>Descubre nuestro catálogo y alquila de manera rápida y segura.</p>
        <a class="btn-primary" href="{{route('catalogo')}}">Ver Catálogo</a>
    </div>
</section>

@endsection
