<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $papels = [
            ['papel' => 'PRESIDE'],
            ['papel' => 'MINISTERIO DOMINGO'],
            ['papel' => 'PREDICACION'],
            ['papel' => 'MINISTERIO MIERCOLES'],
            ['papel' => 'MINISTERIO SABADO'],
            // Agrega más registros según sea necesario
        ];

        DB::table('papels')->insert($papels);
    }
}
