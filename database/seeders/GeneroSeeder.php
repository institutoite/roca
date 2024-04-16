<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('generos')->insert([
            'genero' => 'ministerio',
        ]);
        DB::table('generos')->insert([
            'genero' => 'predicacion',
        ]);
        DB::table('generos')->insert([
            'genero' => 'oracion',
        ]);
        DB::table('generos')->insert([
            'genero' => 'himno',
        ]);
        DB::table('generos')->insert([
            'genero' => 'quechua',
        ]);
        DB::table('generos')->insert([
            'genero' => 'corohimno',
        ]);
        DB::table('generos')->insert([
            'genero' => 'coroquechua',
        ]);
    }
}
