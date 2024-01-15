<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HermanoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hermanos = [
            ['nombre' => 'Carlos', 'apellidos' => 'Jaramillo'],
            ['nombre' => 'Carmelo', 'apellidos' => 'Illisca'],
            ['nombre' => 'David', 'apellidos' => 'Flores'],
            ['nombre' => 'Domingo', 'apellidos' => 'Andacaba'],
            ['nombre' => 'Eliodoro', 'apellidos' => 'Baron'],
            ['nombre' => 'Froilan', 'apellidos' => 'Canaza'],
            ['nombre' => 'Juan', 'apellidos' => 'Velasquez'],
            ['nombre' => 'Marcial', 'apellidos' => 'Espino'],
            ['nombre' => 'Mario', 'apellidos' => 'Alarcon'],
            ['nombre' => 'Vicente', 'apellidos' => 'Alejandro'],
            ['nombre' => 'Wili', 'apellidos' => 'Garnica'],
            ['nombre' => 'Daniel', 'apellidos' => 'Baron'],
            ['nombre' => 'Alvaro', 'apellidos' => 'Mamani'],
            ['nombre' => 'Diego', 'apellidos' => 'Taquichiri'],
            // Agrega más registros según sea necesario
        ];

        DB::table('hermanos')->insert($hermanos);
    }
}
