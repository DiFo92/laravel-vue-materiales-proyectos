<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Parametro;

class ParametroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Parametro::factory()->count(3)->create();
        Parametro::factory()->create([
            'descripcion' => 'Departamento',
            'valor' => 100,
        ]);
        Parametro::factory()->create([
            'descripcion' => 'Ciudad',
            'valor' => 200,
        ]);
        Parametro::factory()->create([
            'descripcion' => 'Unidad',
            'valor' => 300,
        ]);
    }
}
