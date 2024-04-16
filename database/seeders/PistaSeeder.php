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
            'nombre' => 'LA IDENTIDAD DE UN CRISTIANO',
            'foto' => 'identidad.jpg',
            'hermano_id' => 16,
            'audio'=>'identidad.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'LA FIDELIDAD A DIOS',
            'foto' => 'fidelidad.jpg',
            'hermano_id' => 6,
            'audio'=>'fidelidad.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'LA GRAN TRIBULACION',
            'foto' => 'tribulacion.jpg',
            'hermano_id' => 9,
            'audio'=>'tribulacion.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'FRUTOS DEL ESPIRITU',
            'foto' => 'frutos.jpg',
            'hermano_id' => 10,
            'audio'=>'frutos.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'FRUTOS DEL ESPIRITU 2',
            'foto' => 'frutos2.jpg',
            'hermano_id' => 11,
            'audio'=>'frutos2.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'ABRES CAMINO',
            'foto' => 'abrescamino.jpeg',
            'hermano_id' => 11,
            'audio'=>'abrescamino.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'AL FINAL',
            'foto' => 'final.jpg',
            'hermano_id' => 11,
            'audio'=>'final.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'CHIQUITITA',
            'foto' => 'chiquitita.jpg',
            'hermano_id' => 11,
            'audio'=>'chiquitita.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
    }
}
