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
            'nombre' => 'AL FINAL',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 4,
            'audio'=>'final.mp3',

            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'TITANIC',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 6,
            'audio'=>'titanic.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'ABRES CAMINO',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 9,
            'audio'=>'abrescamino.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'CHIQUITITA',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 10,
            'audio'=>'chiquitita.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
        DB::table('pistas')->insert([
            'nombre' => 'CARIÑOSO SALVADOR HIMNO 17',
            'foto' => 'sinfoto.jpg',
            'hermano_id' => 11,
            'audio'=>'carinoso.mp3',
            'fureproduccion' => now(), // Puedes ajustar la fecha y hora según sea necesario
            'click' => random_int(10,1500),
            'estado' => 1,
        ]);
    }
}
