<?php
namespace Database\Factories;

use App\Models\Alquiler;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alquiler>
 */
class AlquilerFactory extends Factory
{
    /**
     * El nombre del modelo que la fábrica crea.
     *
     * @var string
     */
    protected $model = Alquiler::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'clienteID' => 1,
            'vehiculoID' => 1,
            'fechaRecogida' => $this->faker->date(),
            'fechaEntrega' => $this->faker->date(),
            'importe' => $this->faker->randomFloat(2, 50, 500)
        ];
    }
}
