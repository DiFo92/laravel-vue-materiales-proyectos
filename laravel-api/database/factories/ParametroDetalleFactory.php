<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Parametro;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParametroDetalle>
 */
class ParametroDetalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parametro_id' => Parametro::factory(),
            'descripcion' => $this->faker->unique()->word,
            'valor' => $this->faker->numberBetween(1,100),
        ];
    }
}
