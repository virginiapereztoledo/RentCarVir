<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Controlador para gestionar clientes en la aplicación.
 */
class ClienteController extends Controller
{
    /**
     * Muestra la lista de clientes con paginación.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante.
     * @return \Illuminate\View\View|string Vista de la lista de clientes o renderizado si es una solicitud.
     */
    public function index(Request $request){
        $clientes = Cliente::paginate(10);

        if ($request->ajax()) {
            return view('admin.client-table', compact('clientes'))->render();
        } else {
            return view('admin.cliente-index', compact('clientes'));
        }
    }

    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View Vista del formulario de inicio de sesión.
     */
    public function create(){
        return view("public.login");
    }

    /**
     * Guarda un nuevo cliente en la base de datos.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con los datos del nuevo cliente.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la ruta de edición de perfil del cliente.
     */
    public function store(Request $request){
        // Validación de la solicitud entrante
        $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'domicilio' => 'required|string|max:50',
            'ocupacion' => ['required', Rule::in(['No especificado', 'Empleado', 'Autónomo', 'Estudiante', 'Desempleado'])],
            'fechaNacimiento' => 'required|date|before:-18 years|after:-75 years',
            'username' => 'required|alpha_dash|min:8|max:30|unique:usuario,username',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        $foto= "../storage/persona.png";


        $cliente = Cliente::create(array_merge($request->only("nombre", "apellidos", "domicilio", "ocupacion", "fechaNacimiento"), ["foto" => $foto]));

        $usuario = $cliente->usuario()->create($request->only("username", "password"));

        // Si se proporciona una foto, se guarda
        if ($request->hasFile("foto")) {
            $foto = StorageController::storeImage($request->file("foto"), $cliente->id, "cliente");
            $cliente->update(["foto" => $foto]);
        }

        Auth::login($usuario);

        return redirect()->route("cliente.edit.profile");
    }


    /**
     * Muestra la vista donde el cliente puede editar la información personal.
     *
     * @return \Illuminate\View\View Vista para editar la información personal del cliente.
     */
    public function editProfile(){
        return view("cliente.cliente-edit-profile");
    }

    /**
     * Muestra la vista donde el cliente puede cambiar su contraseña.
     *
     * @return \Illuminate\View\View Vista para editar la contraseña del cliente.
     */
    public function editPassword(){
        return view("cliente.cliente-edit-password");
    }

    /**
     * Actualiza la información personal del cliente.
     *
     * @param \Illuminate\Http.Request $request Solicitud HTTP entrante con los datos actualizados.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página anterior con un mensaje de éxito.
     */
    public function updateProfile(Request $request){
        // Validación de la solicitud entrante
        $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'username' => ['required', 'alpha_dash', 'min:8', 'max:30', Rule::unique("usuario", "username")->ignore(Auth::user())],
            'domicilio' => 'required|string|max:50',
            'ocupacion' => ['required', Rule::in(['No especificado', 'Trabajador', 'Empleado', 'Autónomo', 'Estudiante', 'Desempleado'])],
            'fechaNacimiento' => 'required|date|before:-18 years|after:-75 years',
        ]);

        Auth::user()->utenteable->update($request->except("username"));
        return redirect()->back()->with('success', 'Datos actualizados correctamente');
    }

    /**
     * Actualiza la contraseña del cliente.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con la nueva contraseña.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página anterior con un mensaje de éxito.
     */
    public function updatePassword(Request $request){
        // Validación de la solicitud entrante
        $request->validate([
            'oldPassword' => 'required|current_password',
            'password' => ['required', 'confirmed', 'different:oldPassword', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required'
        ]);
        // Actualizar la contraseña
        Auth::user()->utenteable->usuario->update($request->only("password"));

        return redirect()->back()->with('success', 'Contraseña actualizada correctamente');
    }

    /**
     * Actualiza la foto de perfil del cliente.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con la nueva foto.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página anterior con un mensaje de éxito.
     */
    public function updateImage(Request $request){
        $request->validate([
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $foto = StorageController::updateImage($request->file("foto"), Auth::user()->utenteable->id, "cliente");
        Auth::user()->utenteable->update(["foto" => $foto]);
        return redirect()->back()->with('success', 'Foto de perfil actualizada correctamente');
    }

    /**
     * Elimina los clientes seleccionados.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con los IDs de los clientes a eliminar.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con la URL de redirección o un mensaje de error.
     */
    public function deleteSelected(Request $request){
        $ids = $request->input('ids');
        if (is_array($ids)) {
            Usuario::where("utenteable_type", "App\Models\Cliente")->whereIn("utenteable_id", $ids)->delete();
            Cliente::whereIn("id", $ids)->delete();
            foreach ($ids as $id) {
                StorageController::findAndDeleteImage($id, "cliente");
            }
            return response()->json(['url' => route("cliente.index")]);
        }

        $id = $request->input('id');
        if ($id) {
            Usuario::where("utenteable_type", "App\Models\Cliente")->where("utenteable_id", $id)->delete();
            Cliente::where("id", $id)->delete();
            StorageController::findAndDeleteImage($id, "cliente");
            return response()->json(['url' => route("cliente.index")]);
        }

        return response()->json(['error' => 'No se proporcionaron IDs'], 400);
    }

    /**
     * Elimina todos los clientes.
     *
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la página de inicio de clientes.
     */
    public function deleteAll(){
        Usuario::where("utenteable_type", "App\Models\Cliente")->delete();
        DB::table('cliente')->delete();
        StorageController::deleteDirectory(public_path("storage/cliente"));
        return redirect()->route("cliente.index");
    }
}
