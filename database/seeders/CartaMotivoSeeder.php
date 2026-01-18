<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartaMotivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $motivos = [
            ['motivo' => 'Visita'],
            ['motivo' => 'Familiar'],
            ['motivo' => 'Personal'],
            ['motivo' => 'Conferencia'],
            ['motivo' => 'Trabajo'],
            ['motivo' => 'Salud'],
            ['motivo' => 'Estudios'],
            ['motivo' => 'Viaje'],
            ['motivo' => 'Reunión'],
            ['motivo' => 'Otra actividad'],
        ];

        foreach ($motivos as $m) {
            DB::table('carta_motivos')->updateOrInsert(
                ['motivo' => $m['motivo']],
                ['estado' => 1, 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}
