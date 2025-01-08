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
            ['nombre' => 'SIN', 'apellidos' => 'ASINGAR AUN','iglesia_id'=>1],
            ['nombre' => 'Alvaro', 'apellidos' => 'Mamani','iglesia_id'=>1],
            ['nombre' => 'Carlos', 'apellidos' => 'Jaramillo','iglesia_id'=>1],
            ['nombre' => 'Carmelo', 'apellidos' => 'Illisca','iglesia_id'=>1],
            ['nombre' => 'Daniel', 'apellidos' => 'Baron','iglesia_id'=>1],
            ['nombre' => 'David', 'apellidos' => 'Flores','iglesia_id'=>1],
            ['nombre' => 'Diego', 'apellidos' => 'Taquichiri','iglesia_id'=>1],
            ['nombre' => 'Domingo', 'apellidos' => 'Andacaba','iglesia_id'=>1],
            ['nombre' => 'Eliodoro', 'apellidos' => 'Baron','iglesia_id'=>1],
            ['nombre' => 'Froilan', 'apellidos' => 'Canaza','iglesia_id'=>1],
            ['nombre' => 'Juan', 'apellidos' => 'Velasquez','iglesia_id'=>1],
            ['nombre' => 'Marcial', 'apellidos' => 'Espino','iglesia_id'=>1],
            ['nombre' => 'Mario', 'apellidos' => 'Alarcon','iglesia_id'=>1],
            ['nombre' => 'Vicente', 'apellidos' => 'Alejandro','iglesia_id'=>1],
            ['nombre' => 'Wily', 'apellidos' => 'Garnica','iglesia_id'=>1],
            ['nombre' => 'Filemon', 'apellidos' => 'Mamani',"iglesia_id" => 2],
            // Agrega más registros según sea necesario
        ];

        DB::table('hermanos')->insert($hermanos);
    }
}
