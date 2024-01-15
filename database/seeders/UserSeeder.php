<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Crear un usuario administrador
         User::create([
            'name' => 'Admin',
            'email' => 'informaciones.ite@gmail.com',
            'password' => Hash::make('educabol'),
        ]);

        // Puedes agregar más usuarios según sea necesario
        User::factory(10)->create();
    }
}
