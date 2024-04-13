<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pistas')->insert([
            'nombre' => 'EL ANTICRISTO',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 4,
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'ARMAGEDON',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 6,
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'EL DIOS DE ESTE SIGLO',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 9,
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'SIN TITULO',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 10,
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'EGIPTO',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 11,
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
    }
}
