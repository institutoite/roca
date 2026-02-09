<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class HimnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('himnos:import', [
            '--path' => base_path('himnos_letra_*.json'),
            '--truncate' => true,
        ]);
    }
}
