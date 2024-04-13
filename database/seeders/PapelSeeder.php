<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Hermano;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $papels = [
            ['papel' => 'PRESIDE'],
            ['papel' => 'MINISTERIO DOMINGO'],
            ['papel' => 'PREDICACION'],
            ['papel' => 'MINISTERIO MIERCOLES'],
            ['papel' => 'MINISTERIO SABADO'],
            ['papel' => 'MINISTRO'],
        ];

        DB::table('papels')->insert($papels);

        $sinasignar=Hermano::find(1);
        $sinasignar->papeles()->attach([1,2,3,4,5]);

        $alvaro = Hermano::find(2);
        $alvaro->papeles()->attach([1]);
        
        $carlos = Hermano::find(3);
        $carlos->papeles()->attach([1,3,5]);
        
        $carmelo = Hermano::find(4);
        $carmelo->papeles()->attach([2,3,4,5,6]);
        
        $daniel = Hermano::find(5);
        $daniel->papeles()->attach([1]);

        $david = Hermano::find(6);
        $david->papeles()->attach([3,4,5,6]);
        
        $diego = Hermano::find(7);
        $diego->papeles()->attach([1]);

        $domingo = Hermano::find(8);
        $domingo->papeles()->attach([1]);
        
        $eliodoro = Hermano::find(9);
        $eliodoro->papeles()->attach([2,3,4,5,6]);
        
        $froilan = Hermano::find(10);
        $froilan->papeles()->attach([3,4,5,6]);
        
        $juan = Hermano::find(11);
        $juan->papeles()->attach([2,3,4,5,6]);
        
        $marcial = Hermano::find(12);
        $marcial->papeles()->attach([3,4,5]);
        
        $mario = Hermano::find(13);
        $mario->papeles()->attach([2,4]);
        
        $vicente = Hermano::find(14);
        $vicente->papeles()->attach([1,3,5]);
        
        $wily = Hermano::find(15);
        $wily->papeles()->attach([1,3,5]);
        
    }
}
