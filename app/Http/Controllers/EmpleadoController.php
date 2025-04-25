<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Controlador para gestionar empleados.
 */
class EmpleadoController extends Controller{
    /**
     * Muestra la lista de empleados con paginación.
     *
     * @return \Illuminate\View\View Vista de la lista de empleados.
     */
    public function index()
    {
        return view("admin.empleado-index", ["empleados" => Empleado::paginate(10)]);
    }

    /**
     * Muestra el formulario para crear un nuevo empleado.
     *
     * @return \Illuminate\View\View Vista del formulario para crear un nuevo empleado.
     */
    public function create()
    {
        return view("admin.empleado-create");
    }

    /**
     * Guarda un nuevo empleado en la base de datos.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con los datos del nuevo empleado.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de empleados.
     */
    public function store(Request $request)
    {

        // Verificar si el usuario autenticado tiene permiso para crear un empleado
        $this->authorize('isAdmin');

        // Validación de la solicitud entrante.
        $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'username' => 'required|alpha_dash|min:8|max:30|unique:usuario,username',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'password_confirmation' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Ruta por defecto para la foto de perfil.
        $foto = "../storage/persona.png";

        // Crear el empleado y el usuario asociado.
        $empleado = Empleado::create(array_merge($request->only("nombre", "apellidos"), ["foto" => $foto]));
        $empleado->usuario()->create($request->only("username", "password","utenteable_type", "utenteable_id"));

        // Si se proporciona una foto, se guarda.
        if ($request->hasFile("foto")) {
            $foto = StorageController::storeImage($request->file("foto"), $empleado->id, "empleado");
            $empleado->update(["foto" => $foto]);
        }

        return redirect()->route("empleado.index");
    }

    /**
     * Muestra el formulario para editar un empleado.
     *
     * @param int $id ID del empleado a editar.
     * @return \Illuminate\View\View Vista del formulario de edición de empleado.
     */
    public function edit($id)
    {
        return view("admin.empleado-edit", ["empleado" => Empleado::find($id)]);
    }

    /**
     * Actualiza y guarda los nuevos datos del empleado.
     *
     * @param \Illuminate\Http.Request $request Solicitud HTTP entrante con los datos actualizados.
     * @param \App\Models\Empleado $empleado El empleado a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de empleados.
     */
    public function update(Request $request, Empleado $empleado)
    {
        // Validación de la solicitud entrante.
        $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:30',
            'username' => ['required', 'alpha_dash', 'min:8', 'max:30', Rule::unique('usuario', 'username')->ignore($empleado->usuario)],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Actualiza la contraseña si se proporciona.
        if ($request->filled("password")) {
            $request->validate([
                'password_confirmation' => 'required'
            ]);
            $empleado->usuario->update($request->only("password"));
        }

        // Actualiza el nombre de usuario.
        $empleado->usuario->update($request->only("username"));

        // Actualiza los datos del empleado.
        $empleado->update($request->only("nombre", "apellidos"));

        // Si se proporciona una foto, actualízala.
        if ($request->hasFile("foto")) {
            $foto = StorageController::updateImage($request->file("foto"), $empleado->id, "empleado");
            $empleado->update(["foto" => $foto]);
        }

        return redirect()->route("empleado.index");
    }

    /**
     * Elimina un empleado de la base de datos.
     *
     * @param \App\Models\Empleado $empleado El empleado a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de empleados.
     */
    public function destroy(Empleado $empleado)
    {
        // Elimina la foto de perfil.
        StorageController::findAndDeleteImage($empleado->id, "empleado");

        // Elimina el usuario asociado al empleado.
        $empleado->usuario->delete();

        // Elimina el empleado de la base de datos.
        $empleado->delete();

        return redirect()->route("empleado.index");
    }
}
