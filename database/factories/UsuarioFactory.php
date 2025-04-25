<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * El nombre del modelo que la fábrica crea.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define el estado predeterminado del modelo.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(3, 5000),
            'username' => $this->faker->unique()->userName(),
            'password' => bcrypt('Qwerty123@'),
            'utenteable_type' => 'Admin',
            'remember_token' => Str::random(10),
        ];
    }
}
