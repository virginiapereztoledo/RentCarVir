<?php
namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 *
 * Esta Factory se utiliza para generar instancias de clientes con datos ficticios.
 */
class ClienteFactory extends Factory{
    /**
     * Define el estado predeterminado del modelo de cliente.
     *
     * @return array<string, mixed> Un arreglo asociativo que contiene los valores predeterminados del modelo de cliente.
     */
    public function definition(): array{
        // Genera una fecha de nacimiento entre 19 y 70 años atrás.
        $fechaNacimiento = $this->faker->dateTimeBetween("-70 years", "-19 years");

        // Devuelve un arreglo con los valores predeterminados del cliente.
        return [
            'id' => $this->faker->unique()->numberBetween(3, 5000), // Genera un ID único para el cliente.
            'nombre' => $this->faker->firstName(), // Genera un nombre.
            'apellidos' => $this->faker->lastName(), // Genera apellidos.
            'domicilio' => $this->faker->state(), // Genera un estado/domicilio.
            'ocupacion' => date_diff(Carbon::now(), $fechaNacimiento)->y <= 25 ? "Estudiante" : $this->faker->randomElement(['No especificado', 'Trabajador', 'Autónomo', 'Desempleado']), // Asigna ocupación en función de la edad.
            'fechaNacimiento' => $fechaNacimiento->format("Y-m-d"), // Formatea la fecha de nacimiento.
            'foto' => "storage/avatar.png", // Foto predeterminada.
        ];
    }
}
