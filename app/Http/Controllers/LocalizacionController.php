<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Vehiculo; // Asegúrate de tener el modelo Vehiculo
use Illuminate\Support\Facades\Http;
use App\Models\Alquiler;
class LocalizacionController extends Controller
{
    private $apiKey = '5b3ce3597851110001cf6248d81c5c4c032f4bb58ca1ad54dba6bff1'; // Reemplaza con tu API Key

    // Método INDEX requerido por la ruta
    public function index()
    {
        return view('admin.localizacion'); // Asegúrate que esta vista existe
    }

    /**
     * Obtener todos los vehículos con sus coordenadas.
     */
    public function obtenerVehiculos()
    {
        $hoy = Carbon::now()->toDateString();

        // Obtener vehículos con su reserva activa de hoy
        $vehiculos = Vehiculo::with(['alquiler' => function ($query) use ($hoy) {
            $query->where('fecha_inicio', '<=', $hoy)
                  ->where('fecha_fin', '>=', $hoy);
        }])->get();

        // Formatear los datos que necesita el frontend
        $datos = $vehiculos->map(function ($vehiculo) {
            $reserva = $vehiculo->alquiler->first(); // Solo queremos una reserva activa

            return [
                'matricula' => $vehiculo->matricula,
                'estado' => $reserva ? 'alquilado' : 'disponible',
                'lat' => $vehiculo->lat,
                'lng' => $vehiculo->lng,
                'fecha_reserva_inicio' => $reserva?->fecha_inicio,
                'fecha_reserva_fin' => $reserva?->fecha_fin,
            ];
        });

        return response()->json($datos);
    }


    /**
     * Actualizar la ubicación de un vehículo.
     */
    public function actualizarUbicacionVehiculo(Request $request, $matricula)
    {
        // Validar que los datos necesarios estén presentes en la solicitud
        $validated = $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        // Buscar el vehículo por matrícula
        $vehiculo = Vehiculo::where('matricula', $matricula)->first();

        if (!$vehiculo) {
            return response()->json(['error' => 'Vehículo no encontrado'], 404);
        }

        // Actualizar las coordenadas del vehículo
        $vehiculo->lat = $validated['lat'];
        $vehiculo->lng = $validated['lng'];
        $vehiculo->save();

        return response()->json(['message' => 'Ubicación actualizada correctamente'], 200);
    }

    /**
     * Geocodificación directa (dirección a coordenadas)
     */
    public function obtenerCoordenadas($address)
    {
        $response = Http::get('https://api.openrouteservice.org/geocode/search', [
            'api_key' => $this->apiKey,
            'text' => $address,
            'boundary.country' => 'ES',
            'lang' => 'es'
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['features'])) {
                $coordinates = $data['features'][0]['geometry']['coordinates'];
                return response()->json([
                    'lng' => $coordinates[0], // OpenRouteService usa [lng, lat]
                    'lat' => $coordinates[1]
                ]);
            }
        }

        return response()->json(['error' => 'No se encontraron resultados'], 404);
    }

    /**
     * Geocodificación inversa (coordenadas a dirección)
     */
    public function obtenerDireccion($lat, $lng)
    {
        $response = Http::get('https://api.openrouteservice.org/geocode/reverse', [
            'api_key' => $this->apiKey,
            'point.lon' => $lng,
            'point.lat' => $lat,
            'lang' => 'es'
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['features'])) {
                return response()->json([
                    'direccion' => $data['features'][0]['properties']['label']
                ]);
            }
        }

        return response()->json(['error' => 'Dirección no encontrada'], 404);
    }
}
