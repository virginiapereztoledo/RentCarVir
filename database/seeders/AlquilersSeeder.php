<?php

use Illuminate\Database\Seeder;
use App\Models\Alquiler;

class AlquilersSeeder extends Seeder
{
    public function run()
    {
        Alquiler::create([
            'fechaRecogida' => '2025-04-16',
            'lugarRecogida' => 'Fuengirola',
            'horaRecogida' => '08:00',
            'fechaEntrega' => '2025-04-17',
            'lugarEntrega' => 'Fuengirola',
            'horaEntrega' => '08:00',
            'importe' => 95.00,
            'activo' => 0,
            'clienteID' => 1,
            'vehiculoID' => 13
        ]);

        Alquiler::create([
            'fechaRecogida' => '2025-04-17',
            'lugarRecogida' => 'Fuengirola',
            'horaRecogida' => '08:00',
            'fechaEntrega' => '2025-04-18',
            'lugarEntrega' => 'Fuengirola',
            'horaEntrega' => '08:00',
            'importe' => 75.00,
            'activo' => 1,
            'clienteID' => 4948,
            'vehiculoID' => 12
        ]);

        // Agrega más alquileres aquí con la misma estructura.
    }
}
