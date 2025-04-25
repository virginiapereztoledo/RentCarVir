<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\VehiculoController;
use \App\Http\Controllers\AlquilerController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\EmpleadoController;
use \App\Http\Controllers\LocalizacionController;

// Ruta de acceso principal
Route::view('/', "public/home")->name('home');

// Rutas de acceso público
Route::view("/condiciones", "public/condiciones")->name('condiciones');
Route::view("/contacto", "public/contacto")->name('contacto');
Route::view("/about", "public/about")->name('about');
Route::get("/catalogo", [VehiculoController::class, "search"])->name('catalogo');
Route::post("/catalogo", [AlquilerController::class, "store"])->name('alquiler.store')->middleware("can:doesntHaveAlquiler");
Route::get("/catalogo/vehiculo-{id}", [VehiculoController::class, "mostrar"])->name('vehiculo.mostrar');
Route::post('/reservar', [AlquilerController::class, 'store'])->name('reservar');

// Rutas de inicio, registro y logout
Route::view('login', "public/login")->name('login')->middleware("guest");
Route::post('login', [UsuarioController::class, "authenticate"])->middleware("guest");
Route::view('register', "public/register")->name('register')->middleware("guest");
Route::post('register', [ClienteController::class, "store"])->middleware("guest");
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout')->middleware("auth");

// Rutas de clientes
Route::middleware("can:isClient")->prefix('client')->group(function () {
    Route::prefix('edit')->group(function () {
        Route::put("/updateProfile", [ClienteController::class, 'updateProfile'])->name('cliente.update.profile');
        Route::put("/updatePassword", [ClienteController::class, 'updatePassword'])->name('cliente.update.password');
        Route::put("/updateImage", [ClienteController::class, 'updateImage'])->name('cliente.update.image');
        Route::get("/profile", [ClienteController::class, 'editProfile'])->name('cliente.edit.profile');
        Route::get("/password", [ClienteController::class, 'editPassword'])->name('cliente.edit.password');
        Route::delete('/alquiler/{id}/eliminar', [AlquilerController::class, 'eliminar'])->name('cliente.alquiler.eliminar');
    });
    Route::get("/alquiler", [AlquilerController::class, 'mostrar'])->name('cliente.alquiler');
});

// Rutas de empleados y admins
Route::middleware("can:isEmpleadoOrAdmin")->prefix("management")->group(function () {
    Route::resource('vehiculo', VehiculoController::class)->except("mostrar");
    Route::get('/alquiler/all', [AlquilerController::class, "mostrarAlquilerdelaño"])->name("alquiler.year");
    Route::post('/alquiler', [AlquilerController::class, "mostrarAlquileresMensual"])->name("alquiler.month");
});

// Rutas solo para admin
Route::middleware("can:isAdmin")->prefix("management")->group(function () {
    Route::resource('empleado', EmpleadoController::class, ['except' => ['show']]);

    Route::prefix('cliente')->group(function () {
        Route::get('/all', [ClienteController::class, 'index'])->name('cliente.index');
        Route::post('/delete', [ClienteController::class, "deleteSelected"])->name('cliente.delete');
        Route::post('/delete/all', [ClienteController::class, "deleteAll"])->name('cliente.deleteAll');
    });

    // Ruta para la localización de vehículos
    Route::get('/localizacion', [LocalizacionController::class, 'index'])->name('localizacion');

    // Estadísticas
    Route::get('/estadisticas', [AlquilerController::class, "getEstadisticas"])->name("estadisticas");

    // Rutas para actualizar y obtener localización de vehículos
    Route::post('/vehiculo/{id}/actualizar-localizacion', [VehiculoController::class, 'updateLocation']);
    Route::get('/vehiculo/localizaciones', [VehiculoController::class, 'getLocations']);
});

// Geocodificación directa
Route::get('/geolocalizar/{address}', [LocalizacionController::class, 'obtenerCoordenadas']);

// Geocodificación inversa (nueva)
Route::get('/geolocalizar-inverso/{lat}/{lng}', [LocalizacionController::class, 'obtenerDireccion']);

Route::get('/api/vehiculos', [VehiculoController::class, 'getVehiculos']);

// Ruta para el mapa de localización
Route::get('/management/localizacion', [LocalizacionController::class, 'index'])
    ->name('localizacion')
    ->middleware('can:isAdmin');
