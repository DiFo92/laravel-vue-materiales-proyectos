<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ParametroDetalle;

class ParametroDetalleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // ParametroDetalle::factory()->count(5)->create();
        ParametroDetalle::factory()->create([
            'parametro_id' => 1,
            'descripcion' => 'Cundinamarca',
            'valor' => 1001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => 1,
            'descripcion' => 'Santander',
            'valor' => 1001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => 2,
            'descripcion' => 'Madrid',
            'valor' => 2001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => 2,
            'descripcion' => 'Facatativá',
            'valor' => 2002,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => 2,
            'descripcion' => 'Mosquera',
            'valor' => 2003,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => 3,
            'descripcion' => 'm2',
            'valor' => 3001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => 3,
            'descripcion' => 'und',
            'valor' => 3001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => 3,
            'descripcion' => 'kg',
            'valor' => 3001,
        ]);
    }
}
