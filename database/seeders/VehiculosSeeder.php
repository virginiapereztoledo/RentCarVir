<?php
/*
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculosSeeder extends Seeder
{
    public function run()
    {
        Vehiculo::create([
            'matricula' => '2222AAA',
            'modelo' => 'Yaris Hybrid',
            'marca' => 'Toyota',
            'motor' => 'Hibrido',
            'cambio' => 'Automatico',
            'equipamiento' => 'Navegador',
            'puertas' => '4',
            'asientos' => '5',
            'autonomia' => 600.00,
            'color' => 'Blanco',
            'foto' => 'storage/vehiculo/10.png',
            'descripcion' => 'El Toyota Yaris Hybrid es un coche compacto ideal para ciudad...',
            'disponible' => 1,
            'emision' => '2025-04-15',
            'vencimiento' => '2026-04-15',
            'costoDiario' => 90.00,
        ]);

        Vehiculo::create([
            'matricula' => '2222BBB',
            'modelo' => 'Ioniq Hybrid',
            'marca' => 'Hyundai',
            'motor' => 'Hibrido',
            'cambio' => 'Automatico',
            'equipamiento' => 'Control crucero adaptativo, pantalla táctil, sensores',
            'puertas' => '5',
            'asientos' => '5',
            'autonomia' => 900.00,
            'color' => 'Gris plata',
            'foto' => 'storage/vehiculo/11.png',
            'descripcion' => 'El Hyundai Ioniq Hybrid es una berlina moderna que destaca...',
            'disponible' => 1,
            'emision' => '2025-04-15',
            'vencimiento' => '2026-04-15',
            'costoDiario' => 85.00,
        ]);
        // Agrega más vehículos aquí con la misma estructura.
    }
}
