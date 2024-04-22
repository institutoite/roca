<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paises = [
            ['pais' => 'Bolivia'],
            ['pais' => 'Argentina'],
            ['pais' => 'España'],
            ['pais' => 'Inglaterra'],
            ['pais' => 'Brasil'],
            ['pais' => 'Chile'],
            ['pais' => 'Uruguay'],
            ['pais' => 'Colombia'],
            ['pais' => 'Costa Rica'],
            ['pais' => 'Cuba'],
            ['pais' => 'Ecuador'],
            ['pais' => 'El Salvador'],
            ['pais' => 'Guatemala'],
            ['pais' => 'Honduras'],
            ['pais' => 'México'],
            ['pais' => 'Nicaragua'],
            ['pais' => 'Panamá'],
            ['pais' => 'Paraguay'],
            ['pais' => 'Perú'],
            ['pais' => 'República Dominicana'],
            ['pais' => 'Venezuela'],
            ['pais' => 'Estados Unidos'],
            ['pais' => 'Canadá'],
            ['pais' => 'Australia'],
            ['pais' => 'Francia'],
            ['pais' => 'Alemania'],
            ['pais' => 'Italia'],
            ['pais' => 'Reino Unido'],
            ['pais' => 'Japón'],
            ['pais' => 'China'],
            ['pais' => 'India'],
            ['pais' => 'Portugal'],
            ['pais' => 'Países Bajos'],
            ['pais' => 'Suiza'],
            ['pais' => 'Suecia'],
            ['pais' => 'Noruega'],
            ['pais' => 'Dinamarca'],
            ['pais' => 'Finlandia'],
            ['pais' => 'Bélgica'],
            ['pais' => 'Austria'],
            ['pais' => 'Grecia'],
            ['pais' => 'Irlanda'],
            ['pais' => 'Polonia'],
            ['pais' => 'Rusia'],
            ['pais' => 'Turquía'],
            ['pais' => 'Corea del Sur'],
            ['pais' => 'Singapur'],
            ['pais' => 'Malasia'],
            ['pais' => 'Indonesia'],
            ['pais' => 'Tailandia'],
            ['pais' => 'Filipinas'],
            
        ];
        
        DB::table('pais')->insert($paises);
    }
}
