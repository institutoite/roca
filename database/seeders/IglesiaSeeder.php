<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IglesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('iglesias')->insert([
            [
                'nombre' => 'Roca y Coronado',
                'Direccion' => 'Calle Principal #123',
                'coordenadax' => '-17.7833',
                'coordenaday' => '-63.1821',
                'pais_id' => 1,
                'departamento_id' => 1,
                'provincia_id' => 1,
                'municipio_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Puerdo Rico A',
                'Direccion' => 'Carretera pasando Torno',
                'coordenadax' => '-17.8011',
                'coordenaday' => '-63.1999',
                'pais_id' => 1,
                'departamento_id' => 2,
                'provincia_id' => 3,
                'municipio_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Iglesia Samaria II',
                'Direccion' => 'Barrio Esperanza #789',
                'coordenadax' => null,
                'coordenaday' => null,
                'pais_id' => 2,
                'departamento_id' => 4,
                'provincia_id' => 5,
                'municipio_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
