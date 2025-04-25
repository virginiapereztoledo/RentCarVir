<?php

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        Cliente::create([
            'nombre' => 'cliente',
            'apellidos' => 'cliente',
            'domicilio' => 'calle fuengirola',
            'ocupacion' => 'Estudiante',
            'fechaNacimiento' => '1995-01-01',
            'foto' => 'storage/cliente/1.png'
        ]);

        Cliente::create([
            'nombre' => 'clienteuno',
            'apellidos' => 'clienteuno',
            'domicilio' => 'sin',
            'ocupacion' => 'No especificado',
            'fechaNacimiento' => '2000-10-10',
            'foto' => 'storage/cliente/4946.png'
        ]);

        // Agrega más clientes aquí con la misma estructura.
    }
}
