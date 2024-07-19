<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parametro;
use App\Models\ParametroDetalle;
use App\Models\Material;
use App\Models\Proyecto;
use App\Models\ProyectoMaterial;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // $this->call([
        //     MaterialsTableSeeder::class,
        //     ProyectosTableSeeder::class,
        //     ParametroTableSeeder::class,
        //     ParametroDetalleTableSeeder::class
        // ]);


        User::factory()->create([
            'name' => 'Diego Forero',
            'email' => 'difo92@gmail.com',
        ]);

        $departamento = Parametro::factory()->create([
            'descripcion' => 'Departamento',
            'valor' => 100,
        ]);
        $ciudad = Parametro::factory()->create([
            'descripcion' => 'Ciudad',
            'valor' => 200,
        ]);
        $unidad = Parametro::factory()->create([
            'descripcion' => 'Unidad',
            'valor' => 300,
        ]);

        $cundinamarca = ParametroDetalle::factory()->create([
            'parametro_id' => $departamento,
            'descripcion' => 'Cundinamarca',
            'valor' => 1001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => $departamento,
            'descripcion' => 'Santander',
            'valor' => 1001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => $ciudad,
            'descripcion' => 'Madrid',
            'valor' => 2001,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => $ciudad,
            'descripcion' => 'Facatativá',
            'valor' => 2002,
        ]);
        $mosquera = ParametroDetalle::factory()->create([
            'parametro_id' => $ciudad,
            'descripcion' => 'Mosquera',
            'valor' => 2003,
        ]);
        ParametroDetalle::factory()->create([
            'parametro_id' => $unidad,
            'descripcion' => 'm2',
            'valor' => 3001,
        ]);
        $und = ParametroDetalle::factory()->create([
            'parametro_id' => $unidad,
            'descripcion' => 'und',
            'valor' => 3001,
        ]);
        $kg = ParametroDetalle::factory()->create([
            'parametro_id' => $unidad,
            'descripcion' => 'kg',
            'valor' => 3001,
        ]);

        $proyecto = Proyecto::factory()->create([
            'nombre' => 'Proyecto 1',
            'departamento_id' => $cundinamarca,
            'ciudad_id' => $mosquera
        ]);
        $material = Material::factory()->create([
            'codigo' => 'cod-1',
            'descripcion' => 'varilla 1 CM diametro y 5 mts largo',
            'precio' => 10.000,
            'unidad_id' => $und
        ]);
    }
}
