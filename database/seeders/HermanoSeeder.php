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
            ['nombre' => 'SIN', 'apellidos' => 'ASINGAR AUN', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Alvaro', 'apellidos' => 'Mamani', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Carlos', 'apellidos' => 'Jaramillo', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Carmelo', 'apellidos' => 'Illisca', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Daniel', 'apellidos' => 'Baron', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'David', 'apellidos' => 'Flores', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Diego', 'apellidos' => 'Taquichiri', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Domingo', 'apellidos' => 'Andacaba', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Eliodoro', 'apellidos' => 'Baron', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Froilan', 'apellidos' => 'Canaza', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Juan', 'apellidos' => 'Velasquez', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Marcial', 'apellidos' => 'Espino', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Mario', 'apellidos' => 'Alarcon', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Vicente', 'apellidos' => 'Alejandro', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Wily', 'apellidos' => 'Garnica', 'genero' => 'M', 'iglesia_id' => 1],
            ['nombre' => 'Filemon', 'apellidos' => 'Mamani', 'genero' => 'M', 'iglesia_id' => 2],
            // Agrega más registros según sea necesario
        ];

        DB::table('hermanos')->insert($hermanos);
    }
}
