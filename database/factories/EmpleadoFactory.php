<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories.Factory<\App\Models\Empleado>
 *
 * Esta Factory se utiliza para generar instancias de empleados con datos ficticios.
 */
class EmpleadoFactory extends Factory{
    /**
     * Define el estado predeterminado del modelo de empleado.
     *
     * @return array<string, mixed> Un arreglo asociativo que contiene los valores predeterminados del modelo de empleado.
     */
    public function definition(): array{
        return [
            'id' => $this->faker->unique()->numberBetween(3, 5000), // Genera un ID único para el empleado.
            'nombre' => $this->faker->firstName(), // Genera un nombre.
            'apellidos' => $this->faker->lastName(), // Genera apellidos.
            'foto' => 'storage/avatar.png', // Establece una foto predeterminada.
        ];
    }
}
