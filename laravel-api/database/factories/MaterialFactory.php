<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->word,
            'descripcion' => $this->faker->sentence,
            'unidad_id' => $this->faker->randomElement(['m2', 'und', 'kg']),
            'precio' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
