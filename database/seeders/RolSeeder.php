<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gestionInicial = 2024;
        $roles = [];

        for ($i = 0; $i < 12; $i++) { // Crear un registro para cada mes del año
            $mes = date('F', mktime(0, 0, 0, $i + 1, 1));
            $gestion = $gestionInicial;

            $roles[] = [
                'mes' => $mes,
                'gestion' => $gestion,
            ];

            if ($mes == 'December') {
                $gestionInicial++;
            }
        }

        DB::table('rols')->insert($roles);
    }
}
