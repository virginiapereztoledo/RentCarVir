<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Alquiler;
use App\Models\Usuario;
use Illuminate\Support\Facades\Gate;

/**
 * La Política de Roles de autenticación de la aplicación.
 */
class AppServiceProvider extends ServiceProvider{
    /**
     * Las políticas de la aplicación.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Inicializador de autenticación.
     */
    public function boot(){
        $this->registerPolicies();

        // Define la política para verificar si el usuario es un admin.
        Gate::define('isAdmin', function(Usuario $usuario) {
            return $usuario->utenteable_type == 'Admin';
        });

        // Define la política para verificar si el usuario es un empleado.
        Gate::define('isEmpleado', function(Usuario $usuario) {
            return $usuario->utenteable_type == 'App\Models\Empleado';
        });

        // Define la política para verificar si el usuario es un empleado o administrador.
        Gate::define('isEmpleadoOrAdmin', function() {
            return Gate::allows("isEmpleado") or Gate::allows("isAdmin");
        });

        // Define la política para verificar si el usuario es un cliente.
        Gate::define('isClient', function(Usuario $usuario) {
            return $usuario->utenteable_type == 'App\Models\Cliente';
        });

        // Define la política para verificar si el usuario no tiene alquiler activo.
        Gate::define('doesntHaveAlquiler', function(Usuario $usuario) {
            return Gate::allows("isClient") && !Alquiler::where("clienteID", $usuario->utenteable_id)->where("activo", true)->exists();
        });
    }
}
