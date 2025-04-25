<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

/**
 * Controlador para gestionar la autenticación de usuarios.
 */
class UsuarioController extends Controller
{
    /**
     * Controla el proceso de inicio de sesión de los usuarios y redirige a los usuarios a diferentes áreas de la aplicación según su rol.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con las credenciales del usuario.
     * @return \Illuminate\Http\RedirectResponse Redirecciona al área correspondiente de la aplicación según el rol del usuario.
     */
    public function authenticate(Request $request)
    {
        // Validación de las credenciales de la solicitud entrante.
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Intento de inicio de sesión con las credenciales proporcionadas.
        if (Auth::attempt($credentials)) {
            // Regenerar la sesión después de un inicio de sesión correcto.
            $request->session()->regenerate();

            // Redirige a diferentes vistas de la aplicación según el rol.
            if (Gate::allows('isAdmin')) {
                return redirect()->route('cliente.index');
            } elseif (Gate::allows('isEmpleado')) {
                return redirect()->route('vehiculo.index');
            } elseif (Gate::allows('isClient')) {
                return redirect()->route('cliente.edit.profile');
            }
        }

        // Si las credenciales son incorrectas, redirige atrás con un mensaje de error.
        return back()->withErrors(["status" => 'Credenciales incorrectas.']);
    }

    /**
     * Desconecta a un usuario y lo redirige a la página de inicio.
     *
     * @param \Illuminate\Http.Request $request Solicitud HTTP entrante.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página de inicio.
     */
    public function logout(Request $request)
    {
        // Desconecta al usuario.
        Auth::logout();

        // Invalida la sesión actual.
        $request->session()->invalidate();

        // Regenera el token de sesión.
        $request->session()->regenerateToken();

        // Redirige a la home.
        return redirect()->route("home");
    }
}
