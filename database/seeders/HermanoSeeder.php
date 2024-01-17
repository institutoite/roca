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
            ['nombre' => 'Alvaro', 'apellidos' => 'Mamani'],
            ['nombre' => 'Carlos', 'apellidos' => 'Jaramillo'],
            ['nombre' => 'Carmelo', 'apellidos' => 'Illisca'],
            ['nombre' => 'Daniel', 'apellidos' => 'Baron'],
            ['nombre' => 'David', 'apellidos' => 'Flores'],
            ['nombre' => 'Diego', 'apellidos' => 'Taquichiri'],
            ['nombre' => 'Domingo', 'apellidos' => 'Andacaba'],
            ['nombre' => 'Eliodoro', 'apellidos' => 'Baron'],
            ['nombre' => 'Froilan', 'apellidos' => 'Canaza'],
            ['nombre' => 'Juan', 'apellidos' => 'Velasquez'],
            ['nombre' => 'Marcial', 'apellidos' => 'Espino'],
            ['nombre' => 'Mario', 'apellidos' => 'Alarcon'],
            ['nombre' => 'Vicente', 'apellidos' => 'Alejandro'],
            ['nombre' => 'Wily', 'apellidos' => 'Garnica'],
            // Agrega más registros según sea necesario
        ];

        DB::table('hermanos')->insert($hermanos);
    }
}
