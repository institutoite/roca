<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cuentas')->insert([
            ['nombre' => 'Pro Local', 'tipo' => 'ingreso'],
            ['nombre' => 'Ofrenda de los Santos', 'tipo' => 'ingreso'],
            
            ['nombre' => 'Servicio Basico Agua', 'tipo' => 'egreso'],
            ['nombre' => 'Servicio Basico Luz', 'tipo' => 'egreso'],
            ['nombre' => 'Compra materiales contruccion', 'tipo' => 'egreso'],
            ['nombre' => 'Compra Herramientas', 'tipo' => 'egreso'],
            ['nombre' => 'Ayuda a las viudas', 'tipo' => 'egreso'],
            ['nombre' => 'Ayuda a los enfermos', 'tipo' => 'egreso'],
            ['nombre' => 'Ayuda a iglesia', 'tipo' => 'egreso'],
            ['nombre' => 'Ayuda a los Santos', 'tipo' => 'egreso'],
        ]);
    }
}
