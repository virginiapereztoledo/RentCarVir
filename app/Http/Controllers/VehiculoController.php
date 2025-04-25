<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Validation\Rule;

/**
 * Controlador para gestionar los vehículos.
 */
class VehiculoController extends Controller
{
    /**
     * Muestra la página con los detalles de un vehículo específico.
     *
     * @param int $id ID del vehículo a mostrar.
     * @return \Illuminate\View\View Vista con los detalles del vehículo.
     */
    public function mostrar($id){
        $vehiculo = Vehiculo::findOrFail($id);
        return view("public/vehiculo-mostrar", ["vehiculo" => $vehiculo]);
    }

    /**
     * Muestra la lista de vehículos con paginación, limitando los resultados a 10.
     *
     * @return \Illuminate\View\View Vista de la lista de vehículos.
     */
    public function index(){
        $vehiculos = Vehiculo::paginate(10);
        return view("empleado.vehiculo-index", ["vehiculos" => $vehiculos]);
    }

    /**
     * Muestra el formulario para crear un nuevo vehículo.
     *
     * @return \Illuminate\View\View Vista del formulario de creación de un nuevo vehículo.
     */
    public function create(){
        return view("empleado.vehiculo-create");
    }

    /**
     * Guarda un nuevo vehículo en la base de datos.
     *
     * @param \Illuminate\Http.Request $request Solicitud HTTP entrante con los datos del nuevo vehículo.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de vehículos.
     */
    public function store(Request $request){
        // Validación.
        $request->validate([
            'matricula' => 'required|regex:/^\d{4}[a-zA-Z]{3}$/|size:7|unique:vehiculo,matricula',
            'modelo' => 'required|max:100',
            'marca' => 'required|max:30',
            'motor' => ['required', Rule::in(values: ["Hibrido"])],
            'cambio' => ['required', Rule::in(["Automatico", "Manual"])],
            'equipamiento' => 'required|max:100',
            'puertas' => ['required', Rule::in(["4", "5"])],
            'asientos' => ['required', Rule::in(["2", "3", "4", "5", "6", "7"])],
            'autonomia' => 'required|gt:0|lt:1000|decimal:0,2',
            'color' => 'required|max:30',
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'descripcion' => 'nullable',
            'emision' => 'required|date|after: -1 day|before: +1 years|size:10',
            'vencimiento' => 'required|date|after:emision|before: +3 years|size:10',
            'costoDiario' => 'required|decimal:0,2|gt:0|lt:10000',
        ]);

        // Crea un nuevo vehículo y guarda la imagen proporcionada.
        $vehiculo = Vehiculo::create($request->except("foto"));
        $foto = StorageController::storeImage($request->file("foto"), $vehiculo->id, "vehiculo");
        $vehiculo->update(["foto" => $foto]);

        return redirect()->route("vehiculo.index");
    }

    /**
     * Muestra el formulario para editar un vehículo.
     *
     * @param \App\Models\Vehiculo $vehiculo El vehículo a editar.
     * @return \Illuminate\View\View Vista del formulario de edición de vehículo.
     */
    public function edit(Vehiculo $vehiculo){
        return view('empleado.vehiculo-edit', ['vehiculo' => $vehiculo]);
    }

    /**
     * Actualiza el vehículo en la base de datos con los datos enviados.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante con los datos actualizados.
     * @param \App\Models\Vehiculo $vehiculo El vehículo a actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de vehículos.
     */
    public function update(Request $request, Vehiculo $vehiculo){
        // Validación de la solicitud entrante.
        $request->validate([
            'matricula' => ['required', 'regex:/^\d{4}[a-zA-Z]{3}$/', 'size:7', Rule::unique('vehiculo', 'matricula')->ignore($vehiculo)],
            'modelo' => 'required|max:100',
            'marca' => 'required|max:30',
            'motor' => ['required', Rule::in(values: ["Hibrido"])],
            'cambio' => ['required', Rule::in(["Automatico", "Manual"])],
            'equipamiento' => 'required|max:100',
            'puertas' => ['required', Rule::in(["4", "5"])],
            'asientos' => ['required', Rule::in(["2", "3", "4", "5", "6", "7"])],
            'autonomia' => 'required|gt:0|lt:1000|decimal:0,2',
            'color' => 'required|max:30',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'descripcion' => 'nullable',
            'costoDiario' => 'required|decimal:0,2|gt:0|lt:10000',
        ]);

        // Si se cambian las fechas de emisión o vencimiento, validar las nuevas fechas.
        if ($request->emision != $vehiculo->emision or $request->vencimiento != $vehiculo->vencimiento) {
            $request->validate([
                'emision' => 'date|after: -1 day|before: +1 years|size:10',
                'vencimiento' => 'date|after:emision|before: +3 years|size:10',
            ]);
        }

        // Actualiza los datos del vehículo.
        $vehiculo->update($request->except("foto"));

        // Si se proporciona una foto, actualízala.
        if ($request->hasFile("foto")) {
            $foto = StorageController::updateImage($request->file("foto"), $vehiculo->id, "vehiculo");
            $vehiculo->update(["foto" => $foto]);
        }

        return redirect()->route("vehiculo.index");
    }

    /**
     * Elimina el vehículo de la base de datos.
     *
     * @param \App\Models\Vehiculo $vehiculo El vehículo a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirecciona a la lista de vehículos.
     */
    public function destroy(Vehiculo $vehiculo){
        // Elimina la foto del vehículo.
        StorageController::findAndDeleteImage($vehiculo->id, "vehiculo");

        // Elimina el vehículo de la base de datos.
        $vehiculo->delete();

        return redirect()->route("vehiculo.index");
    }

    /**
     * Busca los vehículos que cumplen con los filtros.
     *
     * @param \Illuminate\Http.Request $request Solicitud HTTP entrante con los parámetros de búsqueda.
     * @return \Illuminate\View.View Vista del catálogo con los resultados de la búsqueda.
     */
    public function search(Request $request)
    {
        $request->validate([
            'priceMin' => 'nullable|integer|min:0|max:4950',
            'priceMax' => 'nullable|integer|min:10|max:500',
            'asientos' => ['nullable', Rule::in(["2", "3", "4", "5", "6", "7"])],
        ]);

        if ($request->has("fechaRecogida") or $request->has("fechaEntrega")) {
            $request->validate([
                'fechaRecogida' => 'required|date|after:today|before: +1 years|size:10',
                'fechaEntrega' => 'required|date|after:fechaRecogida|before: +3 years|size:10',
                'horaRecogida' => Rule::in(["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30"]),
                'horaEntrega' => Rule::in(["08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30"]),
                'lugarRecogida' => Rule::in(["Fuengirola"]),
                'lugarEntrega' => Rule::in(["Fuengirola"]),
            ]);
        }

        if (
            $request->filled("search") ||
            $request->filled("priceMin") ||
            $request->filled("priceMax") ||
            $request->filled("asientos")
        ) {
            $result = Vehiculo::where("disponible", true)
                ->when($request->filled("priceMin") && $request->filled("priceMax"), function ($q) use ($request) {
                    $q->whereBetween("costoDiario", [$request->priceMin, $request->priceMax]);
                })

                ->when($request->filled("search"), function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->where('modelo', 'LIKE', "%$request->search%")
                            ->orWhere('marca', 'LIKE', "%$request->search%");
                    });
                })

                ->when($request->filled("asientos"), function ($q) use ($request) {
                    $q->where('asientos', $request->asientos);
                })

                // Si además quieres seguir validando que las fechas del coche estén dentro del periodo
                ->when($request->filled("fechaRecogida"), function ($q) use ($request) {
                    $q->whereDate('emision', '<=', $request->fechaRecogida)
                      ->whereDate('vencimiento', '>=', $request->fechaEntrega);
                })

                ->paginate(10);
        } else {
            $result = Vehiculo::where("disponible", true)->paginate(10);
        }

        return view("public.catalogo", ["result" => $result]);
    }
    public function updateLocation(Request $request, $id)
    {
        // Validar los datos enviados
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        // Encontrar el vehículo
        $vehiculo = Vehiculo::findOrFail($id);

        // Actualizar la localización
        $vehiculo->lat = $request->lat;
        $vehiculo->lng = $request->lng;

        // Guardar los cambios
        $vehiculo->save();

        return response()->json([
            'message' => 'Ubicación actualizada correctamente.',
            'vehiculo' => $vehiculo
        ]);
    }
    // Método para obtener las ubicaciones de los vehículos
public function getLocations()
{
    $coches = Vehiculo::select('id', 'matricula', 'lat', 'lng')->get();
    return response()->json($coches);
}
// VehiculoController.php
public function getVehiculos()
{
    return Vehiculo::select(
        'id',
        'matricula',
        'disponible',
        'lat',
        'lng'
    )->get()->map(function ($vehiculo) {
        return [
            'matricula' => $vehiculo->matricula,
            'estado' => $vehiculo->disponible ? 'disponible' : 'alquilado',
            'posicion' => [
                'lat' => $vehiculo->lat ?? 36.536,
                'lng' => $vehiculo->lng ?? -4.622
            ]
        ];
    });
}
public function getAllWithPosicion()
{
    // Asumimos que tu modelo Vehiculo tiene los campos 'matricula', 'estado' y 'lat', 'lng'
    $vehiculos = \App\Models\Vehiculo::select('matricula', 'estado', 'lat', 'lng')->get();

    // Mapeamos los datos para que tengan la estructura esperada en JS
    $vehiculos = $vehiculos->map(function ($vehiculo) {
        return [
            'matricula' => $vehiculo->matricula,
            'estado' => $vehiculo->estado,
            'posicion' => [
                'lat' => $vehiculo->lat,
                'lng' => $vehiculo->lng,
            ],
        ];
    });

    return response()->json($vehiculos);
}
public function getAllForMap()
{
    $vehiculos = Vehiculo::all(); // Asegúrate de que hay más de uno en tu base de datos

    return response()->json($vehiculos->map(function ($vehiculo) {
        return [
            'matricula' => $vehiculo->matricula,
            'estado' => $vehiculo->estado,
            'posicion' => $vehiculo->lat && $vehiculo->lng ? [
                'lat' => $vehiculo->lat,
                'lng' => $vehiculo->lng,
            ] : null,
        ];
    }));
}

}
