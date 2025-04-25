<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class AlquilerController extends Controller
{
    public function mostrar()
    {
        $alquiler = Alquiler::where("clienteID", Auth::user()->utenteable->id)
            ->where("activo", true)
            ->first();

        return view("cliente.cliente-alquiler", ["alquiler" => $alquiler]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('doesntHaveAlquiler')) {
            return redirect()->route('catalogo')->withErrors(['error' => '¡Ya tienes un alquiler activo!']);
        }

        if (
            $request->has('id') && $request->has('fechaRecogida') && $request->has('lugarRecogida') &&
            $request->has('horaRecogida') && $request->has('fechaEntrega') && $request->has('lugarEntrega') &&
            $request->has('horaEntrega')
        ) {
            $request['id'] = Crypt::decrypt($request['id']);
            $request['fechaRecogida'] = Crypt::decrypt($request['fechaRecogida']);
            $request['lugarRecogida'] = Crypt::decrypt($request['lugarRecogida']);
            $request['horaRecogida'] = Crypt::decrypt($request['horaRecogida']);
            $request['fechaEntrega'] = Crypt::decrypt($request['fechaEntrega']);
            $request['lugarEntrega'] = Crypt::decrypt($request['lugarEntrega']);
            $request['horaEntrega'] = Crypt::decrypt($request['horaEntrega']);

            $vehiculo = Vehiculo::find($request->id);

            if ($vehiculo) {
                $importe = $vehiculo->costoDiario * date_diff(
                    date_create($request->fechaRecogida),
                    date_create($request->fechaEntrega)
                )->days;

                $vehiculo->alquiler()->create([
                    "clienteID" => Auth::user()->utenteable->id,
                    "fechaRecogida" => $request->fechaRecogida,
                    "lugarRecogida" => $request->lugarRecogida,
                    "horaRecogida" => $request->horaRecogida,
                    "fechaEntrega" => $request->fechaEntrega,
                    "lugarEntrega" => $request->lugarEntrega,
                    "horaEntrega" => $request->horaEntrega,
                    "importe" => $importe,
                    "activo" => true
                ]);

                // Marcar vehículo como no disponible
                $vehiculo->disponible = false;
                $vehiculo->save();

                return redirect()->route("catalogo")->with("success", "¡Reserva realizada con éxito!");
            } else {
                return redirect()->route("catalogo")->withErrors("error", "Vehículo no encontrado");
            }
        } else {
            return redirect()->route("catalogo")->withErrors("error", "Datos de solicitud incompletos");
        }
    }

    public function eliminar($id)
    {
        $alquiler = Alquiler::where('id', $id)
            ->where('clienteID', Auth::user()->utenteable->id)
            ->where('activo', true)
            ->firstOrFail();

        // Cancelar el alquiler
        $alquiler->activo = false;
        $alquiler->save();

        // Marcar vehículo como disponible
        $vehiculo = $alquiler->vehiculo;
        if ($vehiculo) {
            $vehiculo->disponible = true;
            $vehiculo->save();
        }

        return redirect()->route('cliente.alquiler')->with('success', 'Reserva eliminada correctamente.');
    }

    public function mostrarAlquilerdelaño()
    {
        $alquileres = Alquiler::where('activo', true)->get();
        return view('empleado.alquiler-index', ['alquileres' => $alquileres]);
    }

    public function obtenerAlquilerMensual($month)
    {
        $year = Carbon::today()->year;
        $startDate = Carbon::parse($year . "-" . $month)->startOfMonth()->format("Y-m-d");
        $endDate = Carbon::parse($year . "-" . $month)->endOfMonth()->format("Y-m-d");

        return Alquiler::where('activo', true)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween("fechaRecogida", [$startDate, $endDate])
                    ->orWhereBetween("fechaEntrega", [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where("fechaRecogida", "<", $startDate)
                              ->where("fechaEntrega", ">", $endDate);
                    });
            })
            ->get();
    }

    public function mostrarAlquileresMensual(Request $request)
    {
        $mes = $request->input('mes');

        $alquileres = Alquiler::where('activo', true)
            ->when($mes > 0, function ($query) use ($mes) {
                return $query->whereMonth('fechaRecogida', $mes);
            })
            ->get();

        return view('empleado.alquiler-index', ['alquileres' => $alquileres]);
    }

    public function getEstadisticas()
    {
        $array = [];
        for ($month = 1; $month <= 12; $month++) {
            $array[$month - 1] = count($this->obtenerAlquilerMensual($month));
        }

        return view("admin.estadisticas", ["value" => $array]);
    }
}
